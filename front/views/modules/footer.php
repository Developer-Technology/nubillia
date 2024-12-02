<footer class="content-footer footer bg-footer-theme">

    <div class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">

        <div class="mb-2 mb-md-0">
            <small>
                © 2014 - 
                <script>document.write(new Date().getFullYear())</script>
                <?php if($getSetting->web_setting != ''): ?>
                <a href="<?php echo $getSetting->web_setting; ?>" target="_blank" class="footer-link fw-medium"><?php echo $getSetting->name_company_setting; ?></a>
                <?php else: ?>
                <span class="footer-link fw-medium"><?php echo $getSetting->name_company_setting; ?></span>
                <?php endif; ?>
            </small>
        </div>

        <div class="d-lg-inline-block">
            <span class="footer-link me-4"><small><b>Empresa: </b><?php echo $getStore->name_tenant; ?> | <b>Tienda: </b><?php echo $getStore->name_store; ?></small></span>
        </div>

    </div>

</footer>