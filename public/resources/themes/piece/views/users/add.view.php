<!-- Page Heading -->
<!-- Page Breadcrumb -->
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/"><?= $sidebar_text_dashboard ;?></a></li>
        <?php if ($this->requestAction !== 'default' ) :   ?>
            <li class="breadcrumb-item"><a href="/<?= $this->requestController ;?>"><?php $rc = 'sidebar_text_'.$this->requestController ; echo  $$rc ;?></a></li>
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


<div class="card shadow mb-4">


    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><?= $header_page_title ; ?></h6>
    </div>

    <div class="card-body">

        <form method="post">

            <div class="form-row">
                <div class="form-group col-md-4">
                    <input class="form-control" name="username" placeholder="<?= $users_text_username ; ?>" type="text" value="<?= $this->priorFieldValue('username') ;?>" requird>
                </div>
                <div class="form-group col-md-4">
                    <input class="form-control" name="password" placeholder="<?= $users_text_password ; ?>" type="password" required>
                </div>
                <div class="form-group col-md-4">
                    <input class="form-control" name="cpassword" placeholder="<?= $users_text_cpassword ; ?>" type="password" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <input class="form-control" name="email" placeholder="<?= $users_text_email ; ?>" type="email" value="<?= $this->priorFieldValue('email') ;?>" required>
                </div>
                <div class="form-group col-md-6">
                    <input class="form-control" name="phone" placeholder="<?= $users_text_phone ; ?>" type="tel" value="<?= $this->priorFieldValue('phone') ;?>" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <?php  if (isset($usergroups)) : ?>
                    <select class="form-control" name="rule" required>
                        <option selected ><?= $users_text_rule ; ?></option>
                        <?php foreach ($usergroups as $usergroup) :?>
                        <option <?= $this->priorOptionValue('rule',$usergroup->id) ; ?> value="<?= $usergroup->id ; ?>"><?= $usergroup->name ; ?></option>
                        <?php endforeach;   ?>
                    </select>
                    <?php  endif;  ?>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-md-2">
                    <button type="submit" name="submit" class="btn btn-outline-primary btn-block"><?= $users_text_add ; ?></button>
                </div>

            </div>


        </form>
    </div>
</div>
