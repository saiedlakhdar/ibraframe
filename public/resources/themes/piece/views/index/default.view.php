<!-- Page Breadcrumb -->
<!-- Page Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/"><?= $sidebar_text_dashboard ;?></a></li>
        <?php if ($this->requestAction !== 'default' ) :   ?>
            <li class="breadcrumb-item"><a href="/<?= $this->requestController ;?>"><?php $rc = 'sidebar_text_'.$this->requestController ; echo  ucfirst($$rc) ;?></a></li>
        <?php endif; ?>
        <?php if (isset($header_page_title))  :    ?>
            <li class="breadcrumb-item active" aria-current="page"><?= $header_page_title ;?></li>
        <?php endif; ?>
    </ol>
</nav>

<!--Alert Messanger -->
<?php $messages = $this->Messanger->getmessages() ; if (!empty($messages)) : foreach ($messages as $message) :   ?>
    <div class="alert alert<?= $message[1] ;?> alert-dismissible fade show" id="alert" role="alert">
        <?= $message[0] ;?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endforeach; endif; ?>

<h1>Welcome App </h1>




