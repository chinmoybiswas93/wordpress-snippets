jQuery(document).ready(function () {
  // Click event handler for [data-value="art-poster-without-frame"]
  jQuery('[data-value="art-poster-without-frame"]').click(function () {
    // Add 'selected' class to the clicked element
    jQuery(this).addClass("selected");

    // Trigger the click event for [data-value="black"]
    jQuery('[data-value="black"]').click(Event);
  });

  // Click event handler for [data-value="black"]
  jQuery('[data-value="black"]').click(function (Event) {
    console.log(Event);
  });
});
