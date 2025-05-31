
  const carousel = document.getElementById('testimonialCarousel');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');
  
  let scrollAmount = 0;
  const scrollStep = 320; // approximate width of one card including margin

  prevBtn.addEventListener('click', () => {
    scrollAmount -= scrollStep;
    if (scrollAmount < 0) scrollAmount = 0;
    carousel.style.transform = `translateX(-${scrollAmount}px)`;
  });

  nextBtn.addEventListener('click', () => {
    const maxScroll = carousel.scrollWidth - carousel.parentElement.clientWidth;
    scrollAmount += scrollStep;
    if (scrollAmount > maxScroll) scrollAmount = maxScroll;
    carousel.style.transform = `translateX(-${scrollAmount}px)`;
  });

  $(document).ready(function() {
    // Testimonial popup view
    $('.testimonial-item').click(function(){
        var name = $(this).data('name');
        var designation = $(this).data('designation');
        var testimony = $(this).data('testimony');
        var image = $(this).data('image');
        var rating = $(this).data('rating');

          var stars = '';
          for (var i = 0; i < rating; i++) {
              stars += '&#9733;';
          }

        $('#modalName').text(name);
        $('#modalDesignation').text(designation);
        $('#modalTestimony').text(testimony);
        $('#divModalImage').html('<img id="modalImage" src="'+image+'" alt="'+name+'" style="width: 100px; border-radius: 50%;">');
        $('#modalRating').html('<span>'+stars+'</span>');

        $('#testimonialModal').fadeIn();
    });

    $('.close').click(function(){
        $('#testimonialModal').fadeOut();
    });

    // Optional: close modal on clicking outside
    $(window).click(function(e){
        if ($(e.target).is('#testimonialModal')) {
            $('#testimonialModal').fadeOut();
        }
    });
});