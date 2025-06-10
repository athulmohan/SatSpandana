$( document ).ready(function() {
    var w = window.innerWidth;
   
    if(w > 767){
        $('#menu-jk').scrollToFixed();
    }else{
        $('#menu-jk').scrollToFixed();
    }
    
})

$(document).ready(function(){

    $(".filter-button").click(function(){
        var value = $(this).attr('data-filter');
        
        if(value == "all")
        {
            //$('.filter').removeClass('hidden');
            $('.filter').show('1000');
        }
        else
        {
//            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
//            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
            $(".filter").not('.'+value).hide('3000');
            $('.filter').filter('.'+value).show('3000');
            
        }
    });
    
    if ($(".filter-button").removeClass("active")) {
        $(this).removeClass("active");
    }
    $(this).addClass("active");
});

$(document).ready(function () {
	document.querySelectorAll("form").forEach(form => {
	  form.setAttribute("autocomplete", "off");
	});
});

// $(document).ready(function () {
//     $('.dropdown').hover(function () {
//         $(this).addClass('show');
//         $(this).find('.dropdown-menu').addClass('show');
//     }, function () {
//         $(this).removeClass('show');
//         $(this).find('.dropdown-menu').removeClass('show');
//     });
// });

const $dropdown = $(".dropdown");
const $dropdownToggle = $(".dropdown-toggle");
const $dropdownMenu = $(".dropdown-menu");
const showClass = "show";

$(window).on("load resize", function() {
  if (this.matchMedia("(min-width: 768px)").matches) {
    $dropdown.hover(
      function() {
        const $this = $(this);
        $this.addClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "true");
        $this.find($dropdownMenu).addClass(showClass);
      },
      function() {
        const $this = $(this);
        $this.removeClass(showClass);
        $this.find($dropdownToggle).attr("aria-expanded", "false");
        $this.find($dropdownMenu).removeClass(showClass);
      }
    );
  } else {
    $dropdown.off("mouseenter mouseleave");
  }
});

tinymce.init({
	selector: 'textarea.canvas-text-editor',
	plugins: 'lists link image table code',
	toolbar: 'undo redo | styles | fontfamily fontsize | bold italic underline | alignleft aligncenter alignright alignjustify | outdent indent',
	// font_family_formats:
		// 'Arial=Arial, Helvetica, sans-serif;' +
		// 'Courier New=CourierNew,courier,monospace;' +
		// 'Georgia=georgia,palatino;' +
		// 'Tahoma=tahoma,arial,helvetica,sans-serif;' +
		// 'Verdana=verdana,geneva;' +
		// 'Helvetica=helvetica,arial,sans-serif;' +
		// 'Impact=impact,chicago;' +
		// 'Open Sans=OpenSans, sans-serif;' +
		// 'Roboto=Roboto, sans-serif;' +
		// 'Lato=Lato, sans-serif;' +
		// 'Oswald=Oswald, sans-serif;' +
		// 'Montserrat=Montserrat, sans-serif;' +
		// 'PT Sans=PTSans, sans-serif;' +
		// 'Raleway=Raleway, sans-serif;' +
		// 'Ubuntu=Ubuntu, sans-serif;' +
		// 'Times New Roman=TimesNewRoman, Times, serif;'
// content_style:
// 	"@import url('https://fonts.googleapis.com/css2?family=Oswald&display=swap');"
});