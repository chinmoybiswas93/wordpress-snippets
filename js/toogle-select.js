document.querySelectorAll('[type="checkbox"]').forEach(item => {
    var id = item.id;
    var label = document.querySelector('[for="' + id + '"]');
    label.addEventListener('click', function () {
        this.classList.toggle("clicked");
    })
});
