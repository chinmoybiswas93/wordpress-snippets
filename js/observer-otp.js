
jQuery(document).ready(function ($) {
    setTimeout(function () {
        // Select the target element
        var targetElement = $('.xoo-ml-inline-verify');
        // Select the field to show
        const fieldToShow = document.getElementById('field_2_49');

        // Check if the target element exists
        if (targetElement.length > 0) {
            // Create a new MutationObserver
            var observer = new MutationObserver(function (mutationsList, observer) {
                // Iterate over mutations
                mutationsList.forEach(function (mutation) {
                    // Check if class attribute changed
                    if (mutation.type === 'attributes' && mutation.attributeName === 'class') {
                        // Check if the class 'verified' is added
                        if (targetElement.hasClass('verified')) {
                            // Your code when the class 'verified' is added
                            // console.log('Class "verified" added');
                            fieldToShow.style.setProperty('display', 'block', 'important');
                        } else {
                            // Your code when the class 'verified' is removed
                            // console.log('Class "verified" removed');
                            fieldToShow.style.display = 'none';
                        }
                    }
                });
            });

            // Configure and start the observer
            var observerConfig = {
                attributes: true, // Observe changes to attributes
                attributeFilter: ['class'], // Only observe changes to the 'class' attribute
                attributeOldValue: true // Record the old value of the 'class' attribute
            };

            observer.observe(targetElement[0], observerConfig);
        }
    }, 5000); // Adjust the timeout delay as needed
});
