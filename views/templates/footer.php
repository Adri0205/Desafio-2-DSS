<footer id="sticky-footer" class="flex-shrink-0 py-4 bg-dark text-white-50">
    <div class="container text-center ">
        <small style="color: white;">Copyright &copy; MVC</small>
    </div>
</footer>
<script src="<?php echo constant('URL') ?>public/js/funcionesform.js"></script>
<script>

    if (document.getElementById('sexo')) {
        document.getElementById('sexo').value = '<?php echo $this->persona->getSexo(); ?>';
    }
    if (document.getElementById('ocupacion')) {
        document.getElementById('ocupacion').value = '<?php echo $this->persona->getOcupacion()->getIdOcupacion(); ?>';
    }
</script>