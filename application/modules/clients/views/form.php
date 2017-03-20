<script type="text/javascript">
    $(function () {
        $('#client_name').focus();
        $("#client_country").select2({
            placeholder: "<?php echo trans('country'); ?>",
            allowClear: true
        });
    });
</script>

<form method="post">

    <div id="headerbar">
        <h1><?php echo trans('client_form'); ?></h1>
        <?php $this->layout->load_view('layout/header_buttons'); ?>
    </div>

    <div id="content">

        <?php $this->layout->load_view('layout/alerts'); ?>

        <input class="hidden" name="is_update" type="hidden"
            <?php if ($this->mdl_clients->form_value('is_update')) {
                echo 'value="1"';
            } else {
                echo 'value="0"';
            } ?>
        >

        <fieldset>
            <label><?php echo trans('personal_information'); ?>: </label>
            <div class="input-group">
              <span class="input-group-addon">
                <?php echo trans('active_client'); ?>:
                <input id="client_active" name="client_active" type="checkbox" value="1"
                    <?php if ($this->mdl_clients->form_value('client_active') == 1
                        or !is_numeric($this->mdl_clients->form_value('client_active'))
                    ) {
                        echo 'checked="checked"';
                    } ?>
                >
              </span>
                <input id="client_name" name="client_name" type="text" class="form-control"
                       placeholder="<?php echo trans('client_name'); ?>"
                       value="<?php echo htmlspecialchars($this->mdl_clients->form_value('client_name')); ?>">
            </div>
        </fieldset>

        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <fieldset>
                    <label><?php echo trans('address'); ?>: </label>
<!-- Straße und Hausnummer -->
                    <div class="form-group">
                        <div class="input-group" style="width:100%">
                            <span class="input-group-addon" style="width:20%"> <?php echo trans('street_address'); ?>: </span>
                            <input type="text" name="client_address_1" id="client_address_1" class="form-control"
                                   placeholder="<?php echo trans('street_address'); ?>"
                                   value="<?php echo htmlspecialchars($this->mdl_clients->form_value('client_address_1')); ?>">
                        </div>
                    </div>
<!-- Adress-Zusatz -->
                    <div class="form-group hidden">
                        <div class="input-group" style="width:100%">
                            <span class="input-group-addon" style="width:20%"> <?php echo trans('street_address_2'); ?>: </span>
                            <input type="text" name="client_address_2" id="client_address_2" class="form-control"
                                   placeholder="<?php echo trans('street_address_2'); ?>"
                                   value="<?php echo htmlspecialchars($this->mdl_clients->form_value('client_address_2')); ?>">
                        </div>
                    </div>
<!-- PLZ -->
                    <div class="form-group">
                        <div class="input-group" style="width:100%">
                            <span class="input-group-addon" style="width:20%"> <?php echo trans('zip_code'); ?>: </span>
                            <input type="text" name="client_zip" id="client_zip" class="form-control"
                                   placeholder="<?php echo trans('zip_code'); ?>"
                                   value="<?php echo htmlspecialchars($this->mdl_clients->form_value('client_zip')); ?>">
                        </div>
                    </div>
<!-- Ort -->
                    <div class="form-group">
                        <div class="input-group" style="width:100%">
                            <span class="input-group-addon" style="width:20%"> <?php echo trans('city'); ?>: </span>
                            <input type="text" name="client_city" id="client_city" class="form-control"
                                   placeholder="<?php echo trans('city'); ?>"
                                   value="<?php echo htmlspecialchars($this->mdl_clients->form_value('client_city')); ?>">
                        </div>
                    </div>
<!-- Bundesland  -->
                    <div class="form-group hidden">
                        <div class="input-group" style="width:100%">
                            <span class="input-group-addon" style="width:20%"> <?php echo trans('state'); ?>: </span>
                            <input type="text" name="client_state" id="client_state" class="form-control"
                                   value="<?php echo htmlspecialchars($this->mdl_clients->form_value('client_state')); ?>">
                        </div>
                    </div>
<!-- Land -->
                    <div class="form-group">
                        <div class="input-group" style="width:100%">
                            <span class="input-group-addon" style="width:20%"> <?php echo trans('country'); ?>: </span>
                            <select name="client_country" id="client_country" class="form-control">
                                <option></option>
                                <?php foreach ($countries as $cldr => $country) { ?>
                                    <option value="<?php echo $cldr; ?>"
                                        <?php if ($selected_country == $cldr) {
                                            echo 'selected="selected"';
                                        } ?>
                                    ><?php echo $country ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php if ($custom_fields) { ?>
                        <label><?php echo trans('custom_fields'); ?></label>
                        <?php foreach ($custom_fields as $custom_field) { ?>
                            <div class="form-group">
                                <div class="input-group" style="width:100%">
                                    <span class="input-group-addon" style="width:20%"> <?php echo $custom_field->custom_field_label; ?>: </span>
                                    <input type="text" class="form-control"
                                           name="custom[<?php echo $custom_field->custom_field_column; ?>]"
                                           id="<?php echo $custom_field->custom_field_column; ?>"
                                           value="<?php echo form_prep($this->mdl_clients->form_value('custom[' . $custom_field->custom_field_column . ']')); ?>">
                                </div>
                            </div>
                        <?php } ?>
                    <?php } ?>
                </fieldset>
            </div>

            <div class="col-xs-12 col-sm-6">
                <fieldset>
                    <label><?php echo trans('contact_information'); ?>: </label>
<!-- Telefon -->
                    <div class="form-group" >                       
                        <div class="input-group" style="width:100%">
                            <span class="input-group-addon" style="width:20%"> <?php echo trans('phone_number'); ?>: </span>
                            <input type="text" name="client_phone" id="client_phone" class="form-control"
                                   value="<?php echo htmlspecialchars($this->mdl_clients->form_value('client_phone')); ?>">
                        </div>
                    </div>
<!-- Fax -->
                    <div class="form-group">
                        <div class="input-group" style="width:100%">
                            <span class="input-group-addon" style="width:20%"> <?php echo trans('fax_number'); ?>: </span>
                            <input type="text" name="client_fax" id="client_fax" class="form-control"
                                   value="<?php echo htmlspecialchars($this->mdl_clients->form_value('client_fax')); ?>">
                        </div>
                    </div>
<!-- Mobil -->
                    <div class="form-group">
                        <div class="input-group" style="width:100%">
                            <span class="input-group-addon" style="width:20%"> <?php echo trans('mobile_number'); ?>: </span>
                            <input type="text" name="client_mobile" id="client_mobile" class="form-control"
                                   value="<?php echo htmlspecialchars($this->mdl_clients->form_value('client_mobile')); ?>">
                        </div>
                    </div>
<!-- Email -->
                    <div class="form-group">
                        <div class="input-group" style="width:100%">
                            <span class="input-group-addon" style="width:20%"> <?php echo trans('email_address'); ?>: </span>
                            <input type="text" name="client_email" id="client_email" class="form-control"
                                   value="<?php echo htmlspecialchars($this->mdl_clients->form_value('client_email')); ?>">
                        </div>
                    </div>
<!-- Web -->
                    <div class="form-group">
                        <div class="input-group" style="width:100%">
                            <span class="input-group-addon" style="width:20%"> <?php echo trans('web_address'); ?>: </span>
                            <input type="text" name="client_web" id="client_web" class="form-control"
                                   value="<?php echo htmlspecialchars($this->mdl_clients->form_value('client_web')); ?>">
                        </div>
                    </div>
<!-- UST-ID -->
                    <label><?php echo trans('tax_information'); ?>: </label>
                    <div class="form-group">
                        <div class="input-group" style="width:100%">
                            <span class="input-group-addon" style="width:20%"> <?php echo trans('vat_id'); ?>: </span>
                            <input type="text" name="client_vat_id" id="client_vat_id" class="form-control"
                                   value="<?php echo htmlspecialchars($this->mdl_clients->form_value('client_vat_id')); ?>">
                        </div>
                    </div>
<!-- Steuer-Nr. -->
                    <div class="form-group">
                        <div class="input-group" style="width:100%">
                            <span class="input-group-addon" style="width:20%"> <?php echo trans('tax_code'); ?>: </span>
                            <input type="text" name="client_tax_code" id="client_tax_code" class="form-control"
                                   value="<?php echo htmlspecialchars($this->mdl_clients->form_value('client_tax_code')); ?>">
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</form>
