<?php
$filters = [];

foreach (explode('/', $this->request->here()) as $part) {
    if (strpos($part, ':') === false) {
        continue;
    }

    [$key, $value] = explode(':', $part, 2);
    $filters[$key] = $value;
}

$buildFilterUrl = function ($newFilters) {
    $url = '/events/index/';

    foreach ($newFilters as $key => $value) {
        if ($value === null || $value === '') {
            continue;
        }

        $url .= $key . ':' . $value . '/';
    }

    return $url;
};

$toggleFilterUrl = function ($key, $value) use ($filters, $buildFilterUrl) {
    $newFilters = $filters;

    if (isset($newFilters[$key]) && $newFilters[$key] == $value) {
        unset($newFilters[$key]);
    } else {
        $newFilters[$key] = $value;
    }

    return $buildFilterUrl($newFilters);
};

$removeFilterUrl = function ($key) use ($filters, $buildFilterUrl) {
    $newFilters = $filters;
    unset($newFilters[$key]);

    return $buildFilterUrl($newFilters);
};

$isMyEventsActive = isset($filters['searchemail']) && $filters['searchemail'] === $me['email'];
$isOrgEventsActive = isset($filters['searchorg']) && $filters['searchorg'] == $me['org_id'];

?>


<div class="space-y-6">
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold mb-2"><?php echo __('Events');?></h1>
        </div>
        <button class="flex items-center space-x-2 px-4 py-2 bg-mispblue hover:bg-mispdarkblue rounded-lg transition-colors">
            <i class="fas fa-plus"></i>
            <span>Add Event</span>
        </button>
    </div>
    <div class="events <?php if (!$ajax) echo 'index'; ?> space-y-6">
        <div class="pagination">
            <?php
                $pagination = '<ul class="flex items-center gap-1 text-sm">';
                $pagination .= $this->Paginator->prev(
                    '&laquo; ' . __('previous'), 
                    array(
                        'tag' => 'li', 
                        'escape' => false,
                        'class' => 'px-3 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100'), 
                    null, 
                    array(
                        'tag' => 'li', 
                        'class' => 'px-3 py-2 rounded-md border border-gray-200 text-gray-400 cursor-not-allowed', 
                        'escape' => false, 
                        'disabledTag' => 'span'));
                $pagination .= $this->Paginator->numbers(
                    array(
                        'modulus' => 20, 
                        'separator' => '', 
                        'tag' => 'li', 
                        'currentClass' => 'bg-blue-600 text-white border-blue-600',
                        'currentTag' => 'span',
                        'class' => 'px-3 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100'));
                $pagination .= $this->Paginator->next(
                    __('next') . ' &raquo;', 
                    array(
                        'tag' => 'li', 
                        'escape' => false,
                        'class' => 'px-3 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100'), 
                    null, 
                    array(
                        'tag' => 'li', 
                        'class' => 'px-3 py-2 rounded-md border border-gray-200 text-gray-400 cursor-not-allowed',
                        'escape' => false, 
                        'disabledTag' => 'span'));
                
                $pagination .= '</ul>';

                echo $pagination;
            ?>
        </div>
        <div class="flex flex-wrap gap-2 mb-4">
            <button type="button"
                    id="open-modal"
                    class="px-4 py-2 bg-mispblue text-white rounded">
                <i class="fas fa-filter"></i>
            </button>

            <?= $this->Html->link(
                __('My Events'),
                $toggleFilterUrl('searchemail', $me['email']),
                [
                    'class' => $isMyEventsActive
                        ? 'inline-flex items-center space-x-2 px-4 py-2 bg-mispblue hover:bg-mispdarkblue rounded-lg transition-colors'
                        : 'inline-flex items-center space-x-2 px-4 py-2 bg-mispnight hover:bg-mispblue rounded-lg transition-colors',
                    'escape' => false
                ]
            ) ?>

            <?= $this->Html->link(
                'Org Events',
                $toggleFilterUrl('searchorg', $me['org_id']),
                [
                    'class' => $isOrgEventsActive
                        ? 'inline-flex items-center space-x-2 px-4 py-2 bg-mispblue hover:bg-mispdarkblue rounded-lg transition-colors'
                        : 'inline-flex items-center space-x-2 px-4 py-2 bg-mispnight hover:bg-mispblue rounded-lg transition-colors',
                    'escape' => false
                ]
            ) ?>
            <?php if (!empty($filters)): ?>
                
                    <?php foreach ($filters as $key => $value): ?>
                        <span class="inline-flex items-center gap-2 rounded-full bg-success px-3 py-1 text-sm text-slate-700">
                            <span>
                                <?= h($key) ?>:
                                <strong><?= h($value) ?></strong>
                            </span>

                            <?= $this->Html->link(
                                '×',
                                $removeFilterUrl($key),
                                [
                                    'class' => 'text-slate-500 hover:text-red-600 font-bold',
                                    'escape' => false,
                                    'title' => 'Remove filter'
                                ]
                            ) ?>
                        </span>
                    <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="relative flex">
            <input
                type="text"
                placeholder="search"
                class="w-full pl-4 pr-12 py-3 bg-[#0f1421] border border-gray-800 rounded-lg focus:outline-none focus:border-mispblue transition-colors"
            />
            <button
                class="absolute right-0 top-0 h-full px-4 bg-mispblue hover:bg-mispdarkblue rounded-r-lg transition-colors flex items-center justify-center"
                title="Search"
            >
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</div>


<div id="modal"
     class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">

        <button type="button"
                id="close-modal"
                class="absolute top-2 right-2 text-gray-500">
            ✕
        </button>

        <h2 class="text-xl font-bold mb-4">Formular</h2>

        <form class="space-y-4">
            <input type="text" placeholder="Name"
                   class="w-full border rounded px-3 py-2">

            <input type="email" placeholder="Email"
                   class="w-full border rounded px-3 py-2">

            <button type="submit"
                    class="w-full bg-blue-500 text-white py-2 rounded">
                Apply
            </button>
        </form>

    </div>
</div>

<script>
$(function () {
    $('#open-modal').on('click', function (e) {
        e.preventDefault();

        $('#modal')
            .removeClass('hidden')
            .addClass('flex');
    });

    $('#close-modal').on('click', function (e) {
        e.preventDefault();

        $('#modal')
            .addClass('hidden')
            .removeClass('flex');
    });

    // ESC schließt Modal
    $(document).on('keydown', function (e) {
        if (e.key === 'Escape') {
            $('#modal')
                .addClass('hidden')
                .removeClass('flex');
        }
    });

    // Klick auf Hintergrund schließt Modal
    $('#modal').on('click', function (e) {
        if (e.target === this) {
            $('#modal')
                .addClass('hidden')
                .removeClass('flex');
        }
    });
});
</script>

------------------------
<?php return; ?>

<div>
    <div>
        <?php
            $searchScopes = [
                'searcheventinfo' => __('Event info'),
                'searchall' => __('All fields'),
                'searcheventid' => __('ID / UUID'),
                'searchtags' => __('Tag'),
            ];
            $searchKey = 'searcheventinfo';

            $filterParamsString = [];
            foreach ($passedArgsArray as $k => $v) {
                if (isset($searchScopes["search$k"])) {
                    $searchKey = "search$k";
                }

                $filterParamsString[] = sprintf(
                    '%s: %s',
                    h(ucfirst($k)),
                    h(is_array($v) ? http_build_query($v) : $v)
                );
            }
            $filterParamsString = implode(' & ', $filterParamsString);

            $columnsDescription = [
                'owner_org' => __('Owner org'),
                'is_extension' => __('Extended event'),
                'attribute_count' => __('Attribute count'),
                'creator_user' => __('Creator user'),
                'tags' => __('Tags'),
                'clusters' => __('Clusters'),
                'correlations' => __('Correlations'),
                'sightings' => __('Sightings'),
                'proposals' => __('Proposals'),
                'discussion' => __('Posts'),
                'report_count' => __('Report count'),
                'timestamp' => __('Last modified at'),
                'publish_timestamp' => __('Published at'),
                'highlights' => __('Highlights'),
            ];

            $columnsMenu = [];
            foreach ($possibleColumns as $possibleColumn) {
                $html = in_array($possibleColumn, $columns, true) ? '<i class="fa fa-check"></i> ' : '<i class="fa fa-check" style="visibility: hidden"></i> ';
                $html .= $columnsDescription[$possibleColumn];
                $columnsMenu[] = [
                    'html' => $html,
                    'onClick' => 'eventIndexColumnsToggle',
                    'onClickParams' => [$possibleColumn],
                ];
            }

            $data = array(
                'children' => array(
                    array(
                        'children' => array(
                            array(
                                'id' => 'create-button',
                                'title' => __('Modify filters'),
                                'fa-icon' => 'search',
                                'onClick' => 'getPopup',
                                'onClickParams' => array(h($urlparams), 'events', 'filterEventIndex')
                            )
                        )
                    ),
                    array(
                        'children' => array(
                            array(
                                'id' => 'multi-delete-button',
                                'title' => __('Delete selected events'),
                                'fa-icon' => 'trash',
                                'class' => 'hidden mass-delete',
                                'onClick' => 'multiSelectDeleteEvents'
                            ),
                            array(
                                'id' => 'multi-export-button',
                                'title' => __('Export selected events'),
                                'fa-icon' => 'file-export',
                                'class' => 'hidden mass-export',
                                'onClick' => 'multiSelectExportEvents'
                            )
                        )
                    ),
                    array(
                        'children' => array(
                            array(
                                'requirement' => count($passedArgsArray) > 0,
                                'html' => sprintf(
                                    '<span class="bold">%s</span>: %s',
                                    __('Filters'),
                                    $filterParamsString
                                )
                            ),
                            array(
                                'requirement' => count($passedArgsArray) > 0,
                                'url' => $baseurl . '/events/index',
                                'title' => __('Remove filters'),
                                'fa-icon' => 'times'
                            )
                        )
                    ),
                    array(
                        'children' => array(
                            array(
                                'title' => __('My events only'),
                                'text' => __('My Events'),
                                'data' => array(
                                    'searchemail' => h($me['email'])
                                ),
                                'class' => 'searchFilterButton',
                                'active' => isset($passedArgsArray['email']) && $passedArgsArray['email'] === $me['email']
                            ),
                            array(
                                'title' => __('My organisation\'s events only'),
                                'text' => __('Org Events'),
                                'data' => array(
                                    'searchorg' => h($me['org_id'])
                                ),
                                'class' => 'searchFilterButton',
                                'active' => isset($passedArgsArray['org']) && $passedArgsArray['org'] === $me['org_id']
                            )
                        )
                    ),
                    array(
                        'children' => array(
                            array(
                                'id' => 'simple_filter',
                                'type' => 'group',
                                'class' => 'last',
                                'title' => __('Choose columns to show'),
                                'fa-icon' => 'columns',
                                'children' => $columnsMenu,
                            ),
                        ),
                    ),
                    array(
                        'type' => 'search',
                        'button' => __('Filter'),
                        'placeholder' => __('Enter value to search'),
                        'data' => '',
                        'searchScopes' => $searchScopes,
                        'searchKey' => $searchKey,
                    )
                )
            );
            if (!$ajax) {
                echo $this->element('/genericElements/ListTopBar/scaffold', array('data' => $data));
            }
            echo $this->element('Events/eventIndexTable');
        ?>
        <p>
        <?php
        echo $this->Paginator->counter(array(
        'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
        ));
        ?>
        </p>
        <div class="pagination">
            <?= $pagination ?>
        </div>
    </div>
</div>
<script>
    var passedArgsArray = <?php echo $passedArgs; ?>;
    $(function() {
        $('.searchFilterButton').click(function() {
            runIndexFilter(this);
        });
        $('#quickFilterScopeSelector').change(function() {
            $('#quickFilterField').data('searchkey', this.value)
        });
        $('#quickFilterButton').click(function() {
            runIndexQuickFilter();
        });
    });
</script>
<?php
echo $this->element('genericElements/assetLoader', [
    'css' => ['vis', 'distribution-graph'],
    'js' => ['vis', 'jquery-ui.min', 'network-distribution-graph'],
]);
if (!$ajax) {
    echo $this->element('/genericElements/SideMenu/side_menu', array('menuList' => 'event-collection', 'menuItem' => 'index'));
}
