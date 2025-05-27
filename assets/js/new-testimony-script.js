
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