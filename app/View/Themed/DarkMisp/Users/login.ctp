<div style="w-full mt-16">
    <?php
        echo $this->Session->flash('auth');
    ?>
<div class="dark fixed inset-x-0 top-0 bottom-0 bg-background text-foreground flex items-center justify-center p-4">
    
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-primary/5 rounded-full blur-3xl" ></div>
        <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-primary/5 rounded-full blur-3xl" ></div>
    </div>

    <div class="relative w-full max-w-md">
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center mb-6">
                <div class="relative">
                    <?php if (Configure::read('MISP.welcome_logo') && file_exists(APP . '/files/img/custom/' . Configure::read('MISP.welcome_logo'))): ?>
                        <img class="w-72 h-72" src="<?= $this->Image->base64(APP . 'files/img/custom/' . Configure::read('MISP.welcome_logo')) ?>" alt="<?= __('Logo') ?>" onerror="this.style.display='none';">
                    <?php endif; ?>

                    <?php if (Configure::read('MISP.main_logo') && file_exists(APP . '/files/img/custom/' . Configure::read('MISP.main_logo'))): ?>
                        <img src="<?= $this->Image->base64(APP . 'files/img/custom/' . Configure::read('MISP.main_logo')) ?>" class="block m-x-auto">
                    <?php else: ?>
                        <img src="<?php echo $baseurl?>/img/misp-logo-s-u.png" class="block m-x-auto">
                    <?php endif;?>
                </div>
            </div>
            <h1 class="text-4xl font-bold text-primary tracking-tight mb-2">
                <?php
                    if (Configure::read('MISP.welcome_text_top')) {
                        echo h(Configure::read('MISP.welcome_text_top'));
                    }
                ?>
            </h1>
            <?php
                if (true == Configure::read('MISP.welcome_text_bottom')):
            ?>
            <p class="text-sm text-muted-foreground tracking-widest uppercase">
                <?php
                    echo h(Configure::read('MISP.welcome_text_bottom'));
                ?>
            </p>
            <?php
                endif;
            ?>
            <div class="mt-2 h-px w-32 mx-auto bg-gradient-to-r from-transparent via-primary to-transparent" ></div>
            <?= $this->Flash->render(); ?>
        </div>

    
        <div class="bg-card border border-border rounded-lg p-8 shadow-2xl shadow-primary/10">
        <?php
        if ($formLoginEnabled):
            echo $this->Form->create('User', array(
                'class' => 'space-y-6'
            ));
            ?>
            <div class="mb-6">
                <h2 class="text-center mb-2"><?php echo __('Login');?></h2>
            </div>

            <?php
            echo $this->Form->input('email', array(
                'autocomplete' => 'off', 
                'autofocus',
                'class' => 'w-full px-4 py-3 bg-input border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all',
                'div' => array(
                    'class' => 'input email required'
                ),
                'label' => array(
                    'class' => 'block mb-2 text-sm flex items-center gap-2 w-4 h-4 text-primary'
                ),
                'placeholder' =>"Enter your email address"
            ));

            echo $this->Form->input('password', array(
                'autocomplete' => 'off',
                'class' => 'w-full px-4 py-3 bg-input border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all',
                'div' => array(
                    'class' => 'input password required'
                ),
                'label' => array(
                    'class' => 'block mb-2 text-sm flex items-center gap-2 w-4 h-4 text-primary'
                ),
                'placeholder' => "Enter your password"
            ));

            if (!empty(Configure::read('LinOTPAuth')) && Configure::read('LinOTPAuth.enabled')!== FALSE) {
                echo $this->Form->input('otp', array(
                    'autocomplete' => 'off', 
                    'type' => 'password', 
                    'class' => 'w-full px-4 py-3 bg-input border border-border rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-all',
                    'label' => array(
                        'text' => 'OTP',
                        'class' => 'block mb-2 text-sm flex items-center gap-2 w-4 h-4 text-primary'
                        )
                ));
                ?>
                <div>
                <?php
                echo sprintf(
                    '%s <a class="text-primary" href="%s/selfservice" title="LinOTP Selfservice">LinOTP Selfservice</a> %s',
                    __('Visit'),
                    h(Configure::read('LinOTPAuth.baseUrl')),
                    __('for the One-Time-Password selfservice.')
                );
                ?>
                </div>
                <?php
            }
            ?>
            <?php
            if (!empty(Configure::read('Security.allow_self_registration'))) {
                ?>
                <div>
                <?php
                echo sprintf(
                    '<a class="text-primary" href="%s/users/register" title="%s">%s</a>',
                    $baseurl,
                    __('Registration will be sent to the administrators of the instance for consideration.'),
                    __('No account yet? Register now!')
                );
                ?>
                </div>
                <?php
            }
            ?>
            <?php
            if (!empty(Configure::read('Security.allow_password_forgotten'))) {
                ?>
                <div>
                <?php
                echo  sprintf(
                    '<a class="text-primary" href="%s/users/forgot" title="%s">%s</a>',
                    $baseurl,
                    __('Initiate a password reset.'),
                    __('I have forgotten my password')
                );
                ?>
                </div>
                <?php
            }
            ?>
            <?php 
                echo $this->Form->button(__('Login'), array(
                    'class' => 'w-full px-4 py-3 bg-primary hover:bg-primary/90 text-primary-foreground rounded-lg transition-all shadow-lg shadow-primary/20 font-medium'
                )); 
            ?>
        
    <?php
        echo $this->Form->end();
    endif;
    ?>
        <div class="space-y-6">
            <div>
            <?php
            if (Configure::read('ApacheShibbAuth') == true) {
                echo '<a class="text-center block w-full px-4 py-3 bg-primary hover:bg-primary/90 text-primary-foreground rounded-lg transition-all shadow-lg shadow-primary/20 font-medium"  href="/Shibboleth.sso/Login">Login with SAML</a>';
            }
            ?>
            </div>
            <div>
            <?php
            if (Configure::read('AadAuth') == true) {
                echo '<a class="text-center block w-full px-4 py-3 bg-primary hover:bg-primary/90 text-primary-foreground rounded-lg transition-all shadow-lg shadow-primary/20 font-medium" href="/users/login?AzureAD=enable">Login with AzureAD</a>';
            }
            ?>
            </div>
            <div>
            <?php
            if (Configure::read('OidcAuth') == true && Configure::read('OidcAuth.mixedAuth') == true) {
                echo '<a class="text-center block w-full px-4 py-3 bg-primary hover:bg-primary/90 text-primary-foreground rounded-lg transition-all shadow-lg shadow-primary/20 font-medium" href="/users/login?OidcAuth=enable">Login with OIDC</a>';
            }
            ?>
            </div>
        </div>
    </div>
    <div class="mt-8 text-center text-xs text-muted-foreground">
        <?php if (Configure::read('MISP.welcome_logo2') && file_exists(APP . '/files/img/custom/' . Configure::read('MISP.welcome_logo2'))): ?>
        <div class="w-[250px]">
            <img src="<?= $this->Image->base64(APP . 'files/img/custom/' . Configure::read('MISP.welcome_logo2')) ?>" alt="<?= __('Logo2') ?>" onerror="this.style.display='none';">
        </div>
        <?php endif; ?>
    </div>
    <div class="mt-8 text-center text-xs text-muted-foreground">
        <p>
            <span><?= h(Configure::read('MISP.footermidleft')); ?> Powered by <a href="https://github.com/MISP/MISP" rel="noopener">MISP <?= isset($me['id']) ? h($mispVersionFull) : '' ?></a> <?= h(Configure::read('MISP.footermidright')); ?> - <?= $this->Time->time(time()) ?></span>
        </p>
    </div>
</div>

<script>
$(function() {
    $('#UserLoginForm').submit(function(event) {
        event.preventDefault()
        submitLoginForm()
    });
})

function submitLoginForm() {
    var $form = $('#UserLoginForm')
    var url = $form.attr('action')
    var email = $form.find('#UserEmail').val()
    var password = $form.find('#UserPassword').val()
    var LinOTPAuth = <?= empty(Configure::read('LinOTPAuth')) ? 'false' : 'true' ?>;
    var LinOTPAuthEnabled = <?= empty(Configure::read('LinOTPAuth.enabled')) ? 'false' : 'true' ?>;

    if (LinOTPAuth && LinOTPAuthEnabled) {
        var otp = $form.find('#UserOtp').val()
    }
    if (!$form[0].checkValidity()) {
        $form[0].reportValidity()
    } else {
        fetchFormDataAjax(url, function(html) {
            var formHTML = $(html).find('form#UserLoginForm')
            if (!formHTML.length) {
                window.location = baseurl + '/users/login'
            }
            $('body').append($('<div id="temp" style="display: none"/>').append(formHTML))
            var $tmpForm = $('#temp form#UserLoginForm')
            $tmpForm.find('#UserEmail').val(email)
            $tmpForm.find('#UserPassword').val(password)
            if (LinOTPAuth && LinOTPAuthEnabled) {
                $tmpForm.find('#UserOtp').val(otp)
            }
            $tmpForm.submit()
        })
    }
}
</script>
