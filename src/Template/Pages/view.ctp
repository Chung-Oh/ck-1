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
    <h3><?= __('View Page') ?></h3>
    <ul>
        <li><?php echo $page->title ?></li>
        <li>/<?php echo $page->url ?></li>
        <li><?php echo $page->body ?></li>
        <li><?php echo $page->title_url ?></li>
    </ul>
</div>
