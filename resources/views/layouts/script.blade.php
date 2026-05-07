<script>

    // =========================
    // AUTO HIDE ALERT
    // =========================
    setTimeout(() => {

        let alertBox = document.querySelector('.alert');

        if(alertBox){

            alertBox.style.transition = 'all 0.5s ease';

            alertBox.style.opacity = '0';

            alertBox.style.transform = 'translateY(-10px)';

            setTimeout(() => {

                alertBox.remove();

            }, 500);

        }

    }, 3000);

</script>