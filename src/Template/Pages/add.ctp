<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Page[]|\Cake\Collection\CollectionInterface $page
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Pages'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('New Pages') ?></h3>
    <?php
        echo $this->Form->create($page);
        echo $this->Form->input('title');
        echo $this->Form->input('url');
        echo $this->Form->input('body');
        echo $this->Form->button('Enviar');
        echo $this->Form->end();
    ?>
</div>
