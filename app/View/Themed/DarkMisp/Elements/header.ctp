
<header class="fixed top-0 left-0 right-0 bg-mispnight border-b border-gray-800 px-6 py-4 flex items-center justify-between z-50 h-16">
<?php
if (!empty($me)):
?>
  <div class="flex items-center space-x-4">    
    <button
      class="p-2 hover:bg-gray-800 rounded-lg">
      <i class="fas fa-bars text-mispblue text-xl"></i>
    </button>
    
    
    <a  href="<?= $baseurl ?>" class="flex items-center space-x-2">
      <div class="w-12 h-12 rounded-lg flex items-center justify-center">
        <?php if (Configure::read('MISP.main_logo') && file_exists(APP . '/files/img/custom/' . Configure::read('MISP.main_logo'))): ?>
          <img src="<?= $this->Image->base64(APP . 'files/img/custom/' . Configure::read('MISP.main_logo')) ?>" class="w-10 h-10 block m-x-auto">
        <?php else: ?>
          <img src="<?php echo $baseurl?>/img/misp-logo-main-cmyk-icon coul.png" class="w-10 h-10 block m-x-auto">
        <?php endif;?>
      </div>
      <span class="text-xl font-semibold text-white">MISP - Threat Sharing</span>
    </a>
  </div>

  
  <div class="flex items-center space-x-4">
    
    <div class="relative">
      
      <input type="checkbox" id="plusMenuOpen" class="peer hidden">

      <label for="plusMenuOpen" class="p-2 hover:bg-gray-800 rounded-lg">
        <i class="fa fa-plus text-mispblue text-xl" role="img" aria-label="plusMenuOpen"></i>
      </label>

      <label for="plusMenuOpen"
        class="fixed inset-0 z-10 hidden peer-checked:block">
      </label>

      <div class="absolute right-0 mt-2 w-64 bg-mispnight border border-gray-700 rounded-lg shadow-xl z-20 hidden peer-checked:block">
        <div class="py-2">
          <?php if ($this->Acl->canAccess('bookmarks', 'add')): ?>
          <a href="#" class="w-full px-4 py-2 text-left hover:bg-gray-800 flex items-center space-x-2 text-gray-400">
            <span id="bookmarkThisPageContainer" data-current-page="<?= h($this->here) ?>">
            <i class="fa fa-plus text-mispblue text-xl" role="img"></i>
            Bookmark this page
            <span>
          </a>
          <?php endif;?>

          <?php if ($this->Acl->canAccess('events', 'add')): ?>
          <a href="<?= $baseurl . '/events/add'?>" class="w-full px-4 py-2 text-left hover:bg-gray-800 flex items-center space-x-2">
            <i class="fa fa-plus text-mispblue text-xl" role="img"></i>
            <span class="text-gray-400">Add Event</span>
          </a>
          <?php endif;?>

          <?php if ($this->Acl->canAccess('sharing_groups', 'add')): ?>
          <a href="<?= $baseurl . '/sharing_groups/add'?>" class="w-full px-4 py-2 text-left hover:bg-gray-800 flex items-center space-x-2">
            <i class="fa fa-plus text-mispblue text-xl" role="img"></i>
            <span class="text-gray-400">Add Sharing Group</span>
          </a>
          <?php endif;?>

          <?php if ($this->Acl->canAccess('posts', 'add')): ?>
          <a href="<?= $baseurl . '/posts/add'?>" class="w-full px-4 py-2 text-left hover:bg-gray-800 flex items-center space-x-2">
            <i class="fa fa-plus text-mispblue text-xl" role="img"></i>
            <span class="text-gray-400">Add Discussion</span>
          </a>
          <?php endif;?>

          <?php if ($this->Acl->canAccess('organisations', 'admin_add')): ?>
          <a href="<?= $baseurl . '/admin/organisations/add'?>" class="w-full px-4 py-2 text-left hover:bg-gray-800 flex items-center space-x-2">
            <i class="fa fa-plus text-mispblue text-xl" role="img"></i>
            <span class="text-gray-400">Add Organisation <span class="text-xs text-gray-400">(Admin)</span></span>
          </a>
          <?php endif;?>

          <?php if ($this->Acl->canAccess('users', 'admin_add')): ?>
          <a href="<?= $baseurl . '/admin/users/add'?>" class="w-full px-4 py-2 text-left hover:bg-gray-800 flex items-center space-x-2">
            <i class="fa fa-plus text-mispblue text-xl" role="img"></i>
            <span class="text-gray-400">Add User <span class="text-xs text-gray-400">(Admin)</span></span>
          </a>
          <?php endif;?>
        </div>
      </div>
    </div>


    <div class="relative">
      <input type="checkbox" id="notificationsOpen" class="peer hidden">
      
      <label for="notificationsOpen" class="p-2 hover:bg-gray-800 rounded-lg relative">
        <i class="fa fa-bell text-mispblue text-xl" role="img" aria-label="Notifications"></i>
        <?php if (isset($hasNotifications)): ?>
        <span class="absolute top-1 right-1 w-4 h-4 bg-red-500 rounded-full text-xs flex items-center justify-center text-white"></span>
        <?php endif; ?>
        </label>

      <label for="notificationsOpen"
        class="fixed inset-0 z-10 hidden peer-checked:block">
      </label>
      
      <div class="absolute right-0 mt-2 w-80 bg-mispnight border border-gray-700 rounded-lg shadow-xl z-20 hidden peer-checked:block">
        <div class="px-4 py-3 border-b border-gray-700 flex items-center justify-between">
          <h3 class="font-semibold text-gray-400">Notifications</h3>
          <span class="text-xs text-mispblue">new</span>
        </div>
        <div class="max-h-96 overflow-y-auto">
        </div>
        <div class="px-4 py-2 border-t border-gray-700">
          <a href="<?= $baseurl . '/users/view/me' ?>" class="text-sm text-mispblue hover:text-[#0077bb]">
            View all notifications
          </a>
        </div>
      </div>
    </div>

    <div class="relative">
      <input type="checkbox" id="userMenuOpen" class="peer hidden">

      <label for="userMenuOpen"
        class="flex items-center space-x-2 p-2 hover:bg-gray-800 rounded-lg"
      >
        <div class="w-8 h-8 bg-mispblue rounded-full flex items-center justify-center">
          <i class="far fa-user text-white" role="img" aria-label="userMenuOpen"></i>
        </div>
        <i class="fas fa-chevron-down text-gray-400 text-xs"></i>
      </label>

      <label for="userMenuOpen"
        class="fixed inset-0 z-10 hidden peer-checked:block">
      </label>

      <div class="text-gray-400 absolute right-0 mt-2 w-56 bg-mispnight border border-gray-700 rounded-lg shadow-xl z-20 hidden peer-checked:block">
        <div class="px-4 py-3 border-b border-gray-700">
          <p class="text-sm text-gray-400 font-medium"><?= $me['email'] ?></p>
          <p class="text-xs">Administrator</p>
        </div>
        <div class="py-2">
          <?php if ($this->Acl->canAccess('bookmarks', 'add')): ?>
          <a
            href="<?= $baseurl . '/bookmarks/index'?>"
            class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-800"
          >
            <i class="fas fa-bookmark text-mispblue"></i>
            <span >Bookmarks</span>
          </a>
          <?php endif;?>
          <a
            href="<?= $baseurl . '/users/view/me'?>"
            class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-800"
          >
            <i class="fas fa-user-cog text-mispblue"></i>
            <span>User Settings</span>
          </a>
          <a href="<?= $baseurl . '/users/logout'?>" class="flex items-center space-x-2 w-full px-4 py-2 hover:bg-gray-800 text-red-400">
            <i class="fas fa-sign-out-alt text-red-400"></i>
            <span>Log out</span>
          </a>
        </div>
      </div>
    </div>
  </div>
<?php
endif;
?>
</header>
