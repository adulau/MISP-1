<?php
$location = $this->request->here();
if (!empty($me)):
?>
<aside class="text-gray-400 fixed left-0 top-16 h-[calc(100vh-4rem)] bg-mispnight border-r border-gray-800 transition-all w-64 flex flex-col z-40">
  
  <div class="p-4 border-b border-gray-800 flex justify-end gap-2">
    <button class="p-2 hover:bg-gray-800 rounded-lg transition-colors" title="Sidebar lösen (als Burger-Menü)">
      <i class="fas fa-thumbtack text-mispblue"></i>
    </button>
    <label for="minimizeSidebar" class="p-2 hover:bg-gray-800 rounded-lg transition-colors">
      <i class="far fa-caret-square-left text-mispblue"></i>
    </label>
  </div>
  
  <nav class="flex-1 overflow-y-auto p-4 space-y-2">
    <div>
      <a 
        href="<?= $baseurl .'/dashboards/index' ?>" 
        class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg bg-gray-800  <?= $location == '/dashboards/index' ? ' text-mispblue' : 'text-gray-400' ?>">
        <span class="text-mispblue min-w-5 text-l">
          <i class="fas fa-th-large"></i>
        </span>
        <span" class="text-sm">Dashboards</span>
      </a>
    </div>
    <div>
      <div>

        <input type="checkbox" id="eventsAsideMenu" class="peer hidden"
          <?= str_starts_with($location, '/events/index') || 
              str_starts_with($location, '/attributes/index') ? 'checked' : '' ?>
        >

        <label 
          for="eventsAsideMenu"
          class="w-full flex items-center justify-between px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg">
          <div class="flex items-center space-x-3">
            <span class="text-mispblue min-w-5 text-l">
              <i class="far fa-calendar"></i>
            </span>
            <a href="<?= $baseurl . '/events/index' ?>">
              <span class="text-sm">Events</span>
            </a>
          </div>
          <i class="fas fa-chevron-down text-sm"></i>
        </label>

        <div class="ml-4 mt-1 space-y-1 hidden peer-checked:block">
          <div>
            <a 
              href="<?= $baseurl . '/events/index' ?>" 
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= str_starts_with($location, '/events/index') ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="far fa-calendar"></i>
              </span>
              <span class="text-sm">Events</span>
            </a>
          </div>
          <div>
            <a  
              href="<?= $baseurl . '/attributes/index' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= str_starts_with($location, '/attributes/index') ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-list"></i>
              </span>
              <span class="text-sm">Attributes</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div>
        <input type="checkbox" id="dataModelsAsideMenu" class="peer hidden"
          <?= $location == '/tags/index' || 
              $location == '/tag_collections/index' || 
              $location == '/taxonomies/index' || 
              $location == '/templates/index' || 
              $location == '/objectTemplates/index' ? 'checked' : '' ?>
        >

        <label 
          for="dataModelsAsideMenu"
          class="w-full flex items-center justify-between px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg">
          <div class="flex items-center space-x-3">
            <span class="text-mispblue min-w-4 text-l">
              <i class="fas fa-draw-polygon"></i>
            </span>
            <a href="<?= $baseurl . '/tags/index' ?>">
              <span class="text-sm">Data Models</span>
            </a>
          </div>
          <i class="fas fa-chevron-down text-sm"></i>
        </label>

        <div class="ml-4 mt-1 space-y-1 hidden peer-checked:block">
          <div>
            <a 
              href="<?= $baseurl . '/tags/index'?>" 
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/tags/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-tags"></i>
              </span>
              <span class="text-sm">Tags</span>
            </a>
          </div>
          <div>
            <a  
              href="<?= $baseurl . '/tag_collections/index'?>" 
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/tag_collections/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="text-gray-400">
                <i class="fas fa-university min-w-4 text-sm"></i>
              </span>
              <span class="text-sm">Collections</span>
            </a>
          </div>
          <div>
            <a 
              href="<?= $baseurl . '/taxonomies/index'?>" 
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/taxonomies/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-user-tag"></i>
              </span>
              <span class="text-sm">Taxonomies</span>
            </a>
          </div>
          <div>
            <a  
              href="<?= $baseurl . '/templates/index'?>" 
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/templates/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-file-code"></i>
              </span>
              <span class="text-sm">Templates</span>
            </a>
          </div>
          <div>
            <a 
              href="<?= $baseurl . '/objectTemplates/index' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/objectTemplates/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-cube"></i>
              </span>
              <span class="text-sm">Object Templates</span>
            </a>
          </div>
          <?php
          /**
          <div>
            <a   
              href="<?= $baseurl . '/templates/index'?>" 
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/templates/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-cube"></i>
              </span>
              <span class="text-sm">MISP Objects</span>
            </a>
          </div>
          <div>
            <a    
              href="<?= $baseurl . '/templates/index'?>" 
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/templates/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-filter"></i>
              </span>
              <span class="text-sm">Filters</span>
            </a>
          </div>
           */
          ?>
        </div>
      </div>
    </div>
    <div>
      <div>
        <input type="checkbox" id="galaxyAsideMenu" class="peer hidden"
          <?= $location == '/galaxies/index' || 
              $location == '/galaxy_cluster_relations/index' ? 'checked' : '' ?>
        >

        <label 
          for="galaxyAsideMenu"
          class="w-full flex items-center justify-between px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg">
          <div class="flex items-center space-x-3">
            <span class="text-mispblue min-w-5 text-m">
              <i class="fab fa-empire"></i>
            </span>
            <a href="<?= $baseurl . '/galaxies/index' ?>">
              <span class="text-sm">Galaxies</span>
            </a>
          </div>
          <i class="fas fa-chevron-down text-sm"></i>
        </label>

        <div class="ml-4 mt-1 space-y-1 hidden peer-checked:block">
          <div>
            <a  
              href="<?= $baseurl . '/galaxies/index' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/galaxies/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fab fa-empire"></i>
              </span>
              <span class="text-sm">Galaxies</span>
            </a>
          </div>
          <div>
            <a   
              href="<?= $baseurl . '/galaxy_cluster_relations/index' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/galaxy_cluster_relations/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fab fa-galactic-senate"></i>
              </span>
              <span class="text-sm">Relationships</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div>
        <input type="checkbox" id="collaborationAsideMenu" class="peer hidden"
          <?= str_starts_with($location, '/shadow_attributes/index') || 
              $location == '/threads/index' || 
              $location == '/sharing_groups/index' || 
              $location == '/servers/index' || 
              $location == '/feeds/index' || 
              $location == '/communities/index' ? 'checked' : '' ?>
        >
        
        <label 
          for="collaborationAsideMenu"
          class="w-full flex items-center justify-between px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg">
          <div class="flex items-center space-x-3">
            <span class="text-mispblue min-w-5">
              <i class="fab fa-slideshare text-l"></i>
            </span>
            <a href="<?= $baseurl . '/shadow_attributes/index/all:0' ?>">
              <span class="text-sm">Collaboration</span>
            </a>
          </div>
          <i class="fas fa-chevron-down text-sm"></i>
        </label>

        <div class="ml-4 mt-1 space-y-1 hidden peer-checked:block">
          <div>
            <a    
              href="<?= $baseurl . '/shadow_attributes/index/all:0' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/shadow_attributes/index/all:0' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-file-medical"></i>
              </span>
              <span class="text-sm">Proposals</span>
            </a>
          </div>
          <div>
            <a     
              href="<?= $baseurl . '/threads/index' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/threads/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="far fa-comments"></i>
              </span>
              <span class="text-sm">Discussions</span>
            </a>
          </div>
          <div>
            <a      
              href="<?= $baseurl . '/sharing_groups/index' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/sharing_groups/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-people-arrows"></i>
              </span>
              <span class="text-sm">Sharing Groups</span>
            </a>
          </div>
          <div>
            <a       
              href="<?= $baseurl . '/servers/index' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/servers/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-server"></i>
              </span>
              <span class="text-sm">Remote Servers</span>
            </a>
          </div>
          <div>
            <a        
              href="<?= $baseurl . '/feeds/index' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/feeds/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-rss"></i>
              </span>
              <span class="text-sm">Feeds</span>
            </a>
          </div>
          <div>
            <a         
              href="<?= $baseurl . '/communities/index' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/communities/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-users"></i>
              </span>
              <span class="text-sm">Communities</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div>
      <div>
        <input type="checkbox" id="automationAsideMenu" class="peer hidden"
          <?= $location == '/jobs/index' || 
              $location == '/tasks/index' || 
              $location == '/workflows/triggers' || 
              $location == '/api/openapi' || 
              $location == '/api/rest' ? 'checked' : '' ?>
        >

        <label 
          for="automationAsideMenu"
          class="w-full flex items-center justify-between px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg">
          <div class="flex items-center space-x-3">
            <span class="text-mispblue min-w-5 text-m">
              <i class="fas fa-robot"></i>
            </span>
            <a href="<?= $baseurl . '/jobs/index' ?>">
              <span class="text-sm">Automation</span>
            </a>
          </div>
          <i class="fas fa-chevron-down text-sm"></i>
        </label>

        <div class="ml-4 mt-1 space-y-1 hidden peer-checked:block">
          <div>
            <a    
              href="<?= $baseurl . '/jobs/index' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/jobs/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-tasks"></i>
              </span>
              <span class="text-sm">Jobs</span>
            </a>
          </div>
          <div>
            <a     
              href="<?= $baseurl . '/tasks/index' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/tasks/index' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-calendar-check"></i>
              </span>
              <span class="text-sm">Scheduled Tasks</span>
            </a>
          </div>
          <div>
            <a      
              href="<?= $baseurl . '/workflows/triggers' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/workflows/triggers' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-stream"></i>
              </span>
              <span class="text-sm">Workflows</span>
            </a>
          </div>
          <div>
            <a       
              href="<?= $baseurl . '/api/openapi' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/api/openapi' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-exchange-alt"></i>
              </span>
              <span class="text-sm">OpenAPI</span>
            </a>
          </div>
          <div>
            <a        
              href="<?= $baseurl . '/api/rest' ?>"
              class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg pl-8 <?= $location == '/api/rest' ? ' text-mispblue' : 'text-gray-400' ?>">
              <span class="min-w-4 text-sm">
                <i class="fas fa-exchange-alt"></i>
              </span>
              <span class="text-sm">Rest Client</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    <div>
      <a         
        href="<?= $baseurl . '/event_reports/index' ?>"
        class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg <?= $location == '/event_reports/index' ? ' text-mispblue' : 'text-gray-400' ?>">
        <span class="text-mispblue min-w-5 text-m">
          <i class="fas fa-file-signature"></i>
        </span>
        <span class="text-sm">Reports</span>
      </a>
    </div>
    <div>
      <a          
        href="<?= $baseurl . '/users/statistics/data' ?>"
        class="flex items-center space-x-3 px-4 py-2 hover:bg-gray-800 transition-colors rounded-lg <?= $location == '/users/statistics/data' ? ' text-mispblue' : 'text-gray-400' ?>">
        <span class="text-mispblue min-w-5 text-m">
          <i class="fas fa-chart-bar"></i>
        </span>
        <span class="text-sm">Statistic</span>
      </a>
    </div>
  </nav>

  <div class="p-4 border-t border-gray-800">
    <div class="flex items-center justify-around">
      <button
        type="button"
        data-theme="Default" 
        class="setTheme flex items-center justify-center p-2 hover:bg-gray-800 transition-colors rounded-lg text-gray-400" title="Settings">
        <i class="far fa-lightbulb text-l"></i>
      </a>
      <button
        type="button"
        data-theme="DarkMisp"
        class="setTheme flex items-center justify-center p-2 hover:bg-gray-800 transition-colors rounded-lg text-gray-400" title="Admin">
        <i class="fas fa-lightbulb text-l"></i>
      </a>
    </div>
  </div>
  <div class="p-4 border-t border-gray-800">
    <div class="flex items-center justify-around">
      <a
        href="<?= $baseurl . '/servers/serverSettings' ?>" 
        class="flex items-center justify-center p-2 hover:bg-gray-800 transition-colors rounded-lg text-gray-400" title="Settings">
        <i class="fas fa-cog text-l"></i>
      </a>
      <a 
        href="<?= $baseurl . '/servers/serverSettings' ?>" 
        class="flex items-center justify-center p-2 hover:bg-gray-800 transition-colors rounded-lg text-gray-400" title="Admin">
        <i class="fas fa-user-shield text-l"></i>
      </a>
      
      <a  
        href="https://github.com/MISP/MISP#documentation" target="_blank" 
        class="flex items-center justify-center p-2 hover:bg-gray-800 transition-colors rounded-lg text-gray-400" title="Help">
        <i class="far fa-question-circle text-l"></i>
      </a>
    </div>
  </div>
</aside>

<script>
$(document).ready(function() {
    $('.setTheme').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        var theme = String($(this).data('theme') || '');
        var safeTheme = encodeURIComponent(theme);

        $.ajax({
            type: 'POST',
            url: '<?php echo $baseurl; ?>/user_settings/setTheme/' + safeTheme,
            success: function(data) {
                location.reload();
            },
            error: function(xhr, status, error) {
                alert('<?php echo __('Failed to toggle Beta UI. Please try again.'); ?>');
            }
        });
    });
});
</script>
<?php
endif;
?>
