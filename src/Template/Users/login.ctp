<div class="users form">
    <?php echo $this->Form->create($user, ['class' => 'col-xl-6']) ?>
        <?php echo $this->Form->control('username') ?>
        <?php echo $this->Form->control('password') ?>
        <?php echo $this->Form->button('Acessar') ?>
    <?php echo $this->Form->end() ?>
</div>
