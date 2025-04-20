<script>
    const toast = document.getElementById("toast");
    toast.classList.add("show");
    setTimeout(() => {
        toast.classList.remove("show");
    }, 3000);

    // setTimeout(() => {
    //     window.location.href = window.location.pathname;
    // }, 4000);
</script>