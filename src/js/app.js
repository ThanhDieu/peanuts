$(document).ready(function () {
  $("[data-bs-toggle=popover]").popover({
    container: "body",
    html: true,
    sanitize: false,
  });
  $("[data-bs-toggle=tooltip]").tooltip()
  $(window).on("click scroll", function (e) {
    $("[data-bs-toggle=popover]").each(function () {
      if (
        !$(this).is(e.target) &&
        $(this).has(e.target).length === 0 &&
        $(".popover").has(e.target).length === 0
      ) {
        $(this).popover("hide");
      }
    });
  });
  $(window).on("load", function () {
    $("#preloader").addClass("hide");
  });
  navigator.clipboard;
  setTimeout(() => {
    if (!$("#preloader").hasClass("hide")) $("#preloader").addClass("hide");
  }, 3000);

  var $owl = $(".banner-slide");
  $owl.owlCarousel({
    loop: true,
    nav: true,
    dots: true,
    items: 1,
    navText: [
      '<i class="fa fa-angle-left"></i>',
      '<i class="fa fa-angle-right"></i>',
    ],
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: false,
  });

  $(".hero-control-play").on("click", function () {
    var thiss = $(this);
    if (thiss.hasClass("play")) {
      $owl.trigger("stop.owl.autoplay");
      thiss.removeClass("play");
      $(".banner-slide .owl-dots").addClass("stop");
    } else {
      thiss.addClass("play");
      $owl.trigger("play.owl.autoplay", [5000]);
      $(".banner-slide .owl-dots").removeClass("stop");
    }
  });
  $("#videoModal").on("click", () => {
    closeModal();
  });

  $(".goog-te-combo").change(() => {
    $("#localizationModal").modal("hide");
  });
  /**
   *
   * menu fixed
   */

  $(window).scroll(function () {
    if ($(this).scrollTop() > 60) {
      $("#menu-main").addClass("active");
      $("#header-main").addClass("d-none");
      if ($(".search-form").hasClass("s-active")) {
        $("#menu-main").addClass("search-menu");
      }
      $(".go-to-top").addClass("show");
    } else {
      $("#menu-main").removeClass("active");
      $("#header-main").removeClass("d-none");
      if (!$(".search-form").hasClass("s-active")) {
        $("#menu-main").removeClass("search-menu");
      }
      $(".go-to-top").removeClass("show");
    }
  });
  /**
   * menu mobile
   */
  if ($(window).width() <= 1024) {
    $(".has-mega-menu").click(function () {
      var th = $(this);
      th.children("ul").slideToggle();
    });
    $(".btn-open").click(function () {
      $("#showRightPush").toggleClass("active");
      $(".menu-active").toggleClass("show-menu-mb");
    });

  }

  /**
   * menu active
   */
  var currentHref = $(location).attr('href');

  document.addEventListener("click", function (event) {
    if (event.target.closest("#menu-main")) return;
    $("#showRightPush").removeClass("active");
    $(".menu-active").removeClass("show-menu-mb");
  });
  /**
   * back to top
   */
  $("#backToTop").on("click", function () {
    $("body,html").animate({ scrollTop: 0 }, "slow");
  });

  const dateStr = formatDate();
  $("#clockPT").text(dateStr);
});

var dayArr = [
  "Sunday",
  "Monday",
  "Tuesday",
  "Wednesday",
  "Thursday",
  "Friday",
  "Saturday",
];

var monthArr = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];
formatDate = () => {
  let dateStr = "";

  const d = new Date();
  const d1 = d.toLocaleString("en-US", {
    timeZone: "America/Los_Angeles",
    imeZoneName: "short",
  });
  const d2 = new Date(d1);

  const isPDT = d1.includes("PDT");

  const pt = isPDT ? "PDT" : "PST";
  const day = dayArr[d2.getDay()];
  const month = monthArr[d2.getMonth()];
  const date = d2.getDate();
  const year = d2.getFullYear();
  let hours = d2.getHours();
  hours = hours % 12;
  hours = hours ? hours : 12;
  const minute = d2.getMinutes() < 10 ? `0${d2.getMinutes()}` : d2.getMinutes();
  const ampm = hours >= 12 ? "PM" : "AM";
  dateStr = `${day}, ${month} ${date} ${year} ${hours}:${minute} ${ampm}, ${pt}`;
  return dateStr;
};

var copyText = (value, pageID, txtCopy) => {
  navigator.clipboard.writeText(value).then(
    function () {
      const input = document.getElementById(pageID);
      const text = document.getElementById(txtCopy);
      input.focus();
      input.select();
      text.style.display = "block";
      var test = setTimeout(() => {
        text.style.display = "none";
      }, 1000);
    },
    function () {
      alert("Failure to copy. Check permissions for clipboard");
    }
  );
};
videoPopup = (value) => {
  const html =
    '<iframe src="' +
    value +
    '" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>';
  $("#videoModal .modal-body").html(html);
  $("#videoModal").modal("show");

  var $owl = $(".banner-slide");
  $owl.trigger("stop.owl.autoplay");
  $(".hero-control-play").removeClass("play");
  $(".banner-slide .owl-dots").addClass("stop");
};

closeModal = () => {
  $("#videoModal .modal-body").html("");
  $("#videoModal").modal("hide");
  var $owl = $(".banner-slide");
  $(".hero-control-play").addClass("play");
  $owl.trigger("play.owl.autoplay", [5000]);
  $(".banner-slide .owl-dots").removeClass("stop");
};

printDetail = () => {
  window.print();

}
toggleSearch = () => {
  $(".search-form").toggleClass("s-active");
  $("#searchInput").focus();
  if ($(".search-form").hasClass("s-active")) {
    $("#menu-main").addClass("search-menu");
  } else {
    $("#menu-main.active").removeClass("search-menu");
  }
};

toggleChat = () => {
  Tawk_API.maximize();

  $('.widget-visible').toggleClass('hidden');
}