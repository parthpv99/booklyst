<footer class="page-footer bg-dark text-white">
        <div class="container-fluid text-md-left">
                <div class="container">
                        <div class="row">
                                <div class="col-md-6 mt-3">
                                        <h5 class="text-uppercase">About Us</h5>
                                        <p>Booklyst is a solution to your problem of finding used books at cheapest rate.</p>
                                </div>
                                <div class="col-md-3 offset-md-3 mt-3">
                                        <h5 class="text-uppercase">Contact Us</h5>
                                        <ul class="list-unstyled">
                                                <li><a href="#" class="text-white">Whatsapp</a></li>
                                                <li><a href="#" class="text-white">Instagram</a></li>
                                                <li><a href="#" class="text-white">Facebook</a></li>
                                                <li><a href="#" class="text-white">Twitter</a></li>
                                        </ul>
                                </div>
                        </div>
                </div>
        </div>
        <div class="footer-copyright text-center py-3" style="background-color: #212121;">
                <div class="center text-white">&copy; Copyright 2020 <a href="index.php" class="text-muted">Booklyst</a></div>
        </div>
</footer>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
        $(function() {
                $('.carousel').carousel({
                        interval: 2500,
                        keyboard: true,
                        pause: false,
                });
                $(".card").hover(
                        function() {
                                $(this).addClass('shadow-sm').css('cursor', 'pointer');
                        },
                        function() {
                                $(this).removeClass('shadow-sm');
                        }
                );
        })
</script>
</body>