<?php if (count($errors) > 0) : ?>
    <?php foreach ($errors as $error) : ?>
        <script>
            alert('<?php echo $error; ?>')
        </script>
    <?php endforeach ?>
<?php endif ?>