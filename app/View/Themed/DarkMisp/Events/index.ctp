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
?>


<div class="space-y-6" >
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold mb-2"><?php echo __('Events');?></h1>
        </div>
        <button class="flex items-center space-x-2 px-4 py-2 bg-mispblue hover:bg-mispdarkblue rounded-lg transition-colors cursor-pointer">
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
                        'class' => 'rounded-md border border-mispblue bg-mispblue text-white hover:bg-mispdarkblue [&>a]:block [&>a]:w-full [&>a]:h-full [&>a]:px-3 [&>a]:py-2'), 
                    null, 
                    array(
                        'tag' => 'li', 
                        'class' => 'rounded-md border border-mispblue bg-mispnight text-gray-400 cursor-not-allowed [&>span]:block [&>span]:px-3 [&>span]:py-2', 
                        'escape' => false, 
                        'disabledTag' => 'span'));
                $pagination .= $this->Paginator->numbers(
                    array(
                        'modulus' => 20, 
                        'separator' => '', 
                        'tag' => 'li', 
                        'currentClass' => 'bg-blue-600 text-white border-blue-600',
                        'currentTag' => 'span',
                        'class' => 'px-3 py-2 rounded-md border border-gray-300 text-gray-700 hover:bg-mispblue'));
                $pagination .= $this->Paginator->next(
                    __('next') . ' &raquo;', 
                    array(
                        'tag' => 'li', 
                        'escape' => false,
                        'class' => 'rounded-md border border-mispblue bg-mispblue text-white hover:bg-mispdarkblue [&>a]:block [&>a]:w-full [&>a]:h-full [&>a]:px-3 [&>a]:py-2'), 
                    null, 
                    array(
                        'tag' => 'li', 
                        'class' => 'rounded-md border border-mispblue bg-mispnight text-gray-400 cursor-not-allowed [&>span]:block [&>span]:px-3 [&>span]:py-2',
                        'escape' => false, 
                        'disabledTag' => 'span'));
                
                $pagination .= '</ul>';

                echo $pagination;
            ?>
        </div>
        <div class="flex flex-wrap gap-2 mb-4">
            <div class="flex flex-wrap gap-2 relative">
                <input type="checkbox" id="eventsTableColumnOpen" class="peer hidden">
                <label for="eventsTableColumnOpen"
                    class="px-4 py-2 bg-mispblue text-white rounded cursor-pointer">
                    <i class="fa fa-columns"></i>
                </label>
                <label for="eventsTableColumnOpen"
                    class="fixed inset-0 z-10 hidden peer-checked:block">
                </label>
                <div class="absolute left-0 top-10 mt-2 w-64 bg-mispnight border border-gray-700 rounded-lg shadow-xl z-[9999] hidden peer-checked:block">
                    <div class="p-2">
                        <?= $this->element('Events/event_column_filter', array(
                            'columnsDescription' => $columnsDescription,
                            'possibleColumns' => $possibleColumns,
                        )); ?>
                    </div>
                </div>
            </div>
            <button type="button"
                    id="openEventFilterModal"
                    class="px-4 py-2 bg-mispblue text-white rounded cursor-pointer">
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

<?= $this->element('Events/modal_filter_events'); ?>

<div class="mt-4 space-y-6" >
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

            echo $this->element('Events/eventIndexTable');
        ?>
    </div>
</div>
<div>
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
    // echo $this->element('/genericElements/SideMenu/side_menu', array('menuList' => 'event-collection', 'menuItem' => 'index'));
}
