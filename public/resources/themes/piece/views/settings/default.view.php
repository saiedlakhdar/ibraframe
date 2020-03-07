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

<!--<div class="container setting-contaisssner">-->
    <div class="row setting-container">
<!--        <div class="containr">-->
        <div class="input-group col-2">
            <div class="nav flex-column list-group col-md-12" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="list-group-item list-group-item-action" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false"><?= $users_text_profile ;?></a>
                <a class="list-group-item list-group-item-action" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="false"><?= $users_text_account ;?></a>
                <a class="list-group-item list-group-item-action" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false"><?= ucwords($users_text_change_password);?></a>
            </div>

        </div>
        <div class="input-group col-10">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
<!--                    profile -->
                    <form method="post"  enctype="multipart/form-data">
                        <div class="form-row">

                            <div class="form-row col-md-4 col-sm-4 align-items-center">
                                <div class="form-group col-md-12 align-content-center">
                                    <img class="rounded mx-auto d-block img-thumbnail" id="pushimg" src="<?= $userprofile->picture ?>" alt="Avatar">
                                    <i class="fas fa-camera fa-2x"></i>
                                    <input type="file" name="imagefile" id="input-file" accept="image/*" >
                                </div>
                            </div>
                            <div class="form-row col-md-8 col-sm-8">
                                <div class="form-group col-md-12">
                                    <input type="text" name="firstname" class="form-control"  placeholder="<?= $users_text_firstname ;?>" value="<?= $this->priorFieldValue('firstname',$userprofile);?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="text" name="lastname" class="form-control"  placeholder="<?= $users_text_secondname ;?>" value="<?= $this->priorFieldValue('lastname',$userprofile);?>">
                                </div>
                                <div class="form-group col-md-12">
                                    <select class="form-control" name="country" >
                                        <option value=""><?= $users_text_country ;?></option>
                                        <?php
                                        foreach ($countries as $country) {
                                            echo '<option  '.$this->priorOptionValue('country',$country->country_name ,$userprofile)  .' value="'.$country->country_name.'">'.$country->country_name.'</option>' ;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <select class="form-control" name="gender" >
                                        <option value=""><?= $users_text_gender ;?></option>
                                        <?php
                                        foreach ($genders as $gender) {
                                            echo '<option  '.$this->priorOptionValue('sex',$gender->gender ,$userprofile)  .' value="'.$gender->gender.'">'.$gender->gender.'</option>' ;
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
                                    <input type="date" class="form-control" name="dateofbirth"  placeholder="<?= $users_text_birthday ;?>" value="<?= $this->priorFieldValue('dateofbirth',$userprofile);?>">
                                </div>
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                <div class="form-group col-md-12">
                                    <textarea name="bio"  class="form-control" rows="3" placeholder="<?= $users_text_bio ;?>"><?= $this->priorFieldValue('bio',$userprofile);?></textarea>
                                </div>
                            </div>

                        </div>

                        <button type="submit" name="profile" class="btn btn-outline-primary col-2 "><?= $users_text_save ;?></button>
                    </form>

                </div>
                <div class="tab-pane fade" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
<!--                    account -->
                    <form method="post"  enctype="multipart/form-data">
                        <div class="form-row">
                            <div class="form-row col-12">
                                <div class="form-group col-6">
                                    <input type="text" name="username" class="form-control "  placeholder="<?= $users_text_username ;?>" onkeyup="ajaxq(this)" value="<?= $this->priorFieldValue('username',$user);?>">
                                </div>
                            </div>
                            <div class="form-row col-12 ">
                                <div class="form-group col-6">
                                    <input type="tel" name="phone" class="form-control "  placeholder="<?= $users_text_phone;?>" onkeyup="ajaxq(this)" value="<?= $this->priorFieldValue('phone',$user);?>">
                                </div>
                            </div>

                        </div>

                        <button type="submit" name="account" class="btn btn-outline-primary col-2 "><?= $users_text_save ;?></button>
                    </form>
                </div>
                <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
<!--            change password -->
                    <form method="post"  enctype="multipart/form-data">
                        <div class="form-row">

                            <div class="form-row col-12">
                                <div class="form-group col-6">
                                    <input type="password" name="current_password" class="form-control"  placeholder="<?= $users_text_current_password ;?>">
                                </div>
                            </div>

                            <div class="form-row col-12">
                                <div class="form-group col-6">
                                    <input type="password" name="password" class="form-control"  placeholder="<?= $users_text_password ;?>">
                                </div>

                                <div class="form-group col-6">
                                    <input type="password" name="cpassword" class="form-control"  placeholder="<?= $users_text_cpassword;?>">
                                </div>
                            </div>

                        </div>

                        <button type="submit" name="changepassword" class="btn btn-outline-primary col-2 "><?= $users_text_save ;?></button>
                    </form>
                </div>


            </div>
        </div>

<!--        </div>-->
    </div>
<!--</div>-->

<script>
    ( function () {
        const inputSectected = document.getElementById('input-file'),
            pushimg = document.getElementById('pushimg'),
            pushii = pushimg.parentNode.childNodes[3];
            pushimg.addEventListener("click", function (ev) {
            if (inputSectected) {
                inputSectected.click();
            }
        }, false);
        inputSectected.addEventListener("change", function (ev) {
            const validImageType = ['image/jpeg', 'image/jpeg', 'image/jpeg', 'image/gif', 'image/png', 'image/bmp'];
            if (inputSectected.files && inputSectected.files[0]) {
                if (validImageType.includes(inputSectected.files[0].type)) {
                    pushimg.src = URL.createObjectURL(inputSectected.files[0]);
                }
            }
        }, false);
        pushimg.addEventListener("mouseover", function (ev) {
            pushii.setAttribute("style", "display : block");
        }, false);
        pushimg.addEventListener("mouseleave", function (ev) {
            const pushii = pushimg.parentNode.childNodes[3];
            pushii.setAttribute("style", "display : none");
        }, false);
    })() ;



</script>


