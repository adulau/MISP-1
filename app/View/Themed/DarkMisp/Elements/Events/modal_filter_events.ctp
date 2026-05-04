
<div data-modal
    id="eventFilterModal"
    class="fixed left-0 top-0 right-0 bottom-0 inset-0 bg-black/80 hidden items-center justify-center z-100 backdrop-blur-xs">

    <div class="bg-mispnight rounded-lg shadow-lg w-1/2  relative drop-shadow-xl/50  drop-shadow-cyan-500/50 border-1 border-mispblue">

        <div class="flex items-center justify-between border-b pl-6 pr-3 py-3 bg-mispblue rounded-t-lg">
            <!-- Titel -->
            <h2 class="text-xl font-semibold">
                <?= __('Filter Event Index');?>
            </h2>
            
            <!-- Close Button -->
            <button 
                id="closeEventFilterModal"
                class="w-8 h-8 flex items-center justify-center rounded-full hover:bg-gray-100 transition text-white hover:text-gray-800 cursor-pointer"
                aria-label="Close"
            >
            <i class="fas fa-times"></i>
        </button>
        
    </div>
    <div class="p-6">
            <?php echo $this->Form->create('Event');?>
            <fieldset class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center justify-between mr-3">
                        <?= $this->Form->input('rule', array(
                            'options' => $rules,
                            //'empty' => '(Select a filter)',
                            'class' => 'w-full px-4 py-3 bg-input border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all cursor-pointer',
                            'label' => array(
                                'class' => 'block text-sm flex items-center gap-2 text-primary mr-4 cursor-pointer'
                            ),
                            //'label' => 'Add Filtering Rule',
                            'onchange' => "indexRuleChange();",
                            'div' => false
                        ));?>
                    </div>
                    <div class="w-full mr-3">
                        <?= $this->Form->input('searchpublished', array(
                                'options' => array('0' => __('No'), '1' => __('Yes'), '2' => __('Any')),
                                'class' => 'w-full px-4 py-3 bg-input border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all cursor-pointer',
                                'label' => false,
                                'style' => '',
                                'div' => false
                            ));
                        ?>
                    </div>
                    <div class="">
                        <button type="button"
                            class="min-w-30 bg-mispblue text-white px-4 py-3 rounded cursor-pointer">
                            <i class="fa fa-plus text-xl" role="img" aria-label="plusMenuOpen"></i>
                            Add
                        </button>
                    </div>
                </div>
                <hr>
                <div class="flex items-center justify-between">
                    <button type="button"
                        class="bg-mispblue text-white px-4 py-2 rounded cursor-pointer">
                        Apply
                    </button>
                    <button type="button"
                        class="border-1 border-mispblue bg-mispnight text-white px-4 py-2 rounded cursor-pointer">
                        Cancel
                    </button>
                </div>
            </fieldset>
            <?php echo $this->Form->end();?>
        </div>
    </div>
</div>

<script>
$(function () {
    $('#openEventFilterModal').on('click', function (e) {
        e.preventDefault();

        $('#eventFilterModal')
            .removeClass('hidden')
            .addClass('flex');
    });

    $('#closeEventFilterModal').on('click', function (e) {
        e.preventDefault();

        $('#eventFilterModal')
            .addClass('hidden')
            .removeClass('flex');
    });

    // ESC schließt Modal
    $(document).on('keydown', function (e) {
        if (e.key === 'Escape') {
            $('#eventFilterModal')
                .addClass('hidden')
                .removeClass('flex');
        }
    });

    // Klick auf Hintergrund schließt Modal
    $('#eventFilterModal').on('click', function (e) {
        if (e.target === this) {
            $('#eventFilterModal')
                .addClass('hidden')
                .removeClass('flex');
        }
    });
});
</script>
