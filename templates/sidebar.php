<div class="col-md-2 links">
    <h4 class="mt-3 mb-2 text-center">Polpular Genres</h4>
    <?php foreach($genres as $genre) : ?>
        <div class="ml-5">
            <a href="#" class="text-dark"><?php echo $genre['genre_name']; ?></a>
        </div>
    <?php endforeach;?>
</div>