$(function() {
    
    "use strict";
    
    //===== Prealoder
    
    $(window).on('load', function(event) {
        $('.preloader').delay(500).fadeOut(500);
    });
    
    
    //===== Sticky

    $(window).on('scroll', function (event) {
        var scroll = $(window).scrollTop();
        if (scroll < 20) {
            $(".navbar-area").removeClass("sticky");
            $(".navbar-area img").attr("src", "/assets/site/images/logo.png");
        } else {
            $(".navbar-area").addClass("sticky");
            $(".navbar-area img").attr("src", "/assets/site/images/logo-2.png");
        }
    });

    
    //===== Section Menu Active

    var scrollLink = $('.page-scroll');
    // Active link switching
    $(window).scroll(function () {
        var scrollbarLocation = $(this).scrollTop();

        scrollLink.each(function () {

            var sectionOffset = $(this.hash).offset().top - 73;

            if (sectionOffset <= scrollbarLocation) {
                $(this).parent().addClass('active');
                $(this).parent().siblings().removeClass('active');
            }
        });
    });
    
    
    //===== close navbar-collapse when a  clicked

    $(".navbar-nav a").on('click', function () {
        $(".navbar-collapse").removeClass("show");
    });

    $(".navbar-toggler").on('click', function () {
        $(this).toggleClass("active");
    });

    $(".navbar-nav a").on('click', function () {
        $(".navbar-toggler").removeClass('active');
    });
    
    
    //===== Sidebar

    $('[href="#side-menu-left"], .overlay-left').on('click', function (event) {
        $('.sidebar-left, .overlay-left').addClass('open');
    });

    $('[href="#close"], .overlay-left').on('click', function (event) {
        $('.sidebar-left, .overlay-left').removeClass('open');
    });
    
    
    //===== Slick

    $('.slider-items-active').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        speed: 800,
        arrows: true,
        prevArrow: '<span class="prev"><i class="lni lni-arrow-left"></i></span>',
        nextArrow: '<span class="next"><i class="lni lni-arrow-right"></i></span>',
        dots: true,
        autoplay: true,
        autoplaySpeed: 5000,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 1,
                    arrows: false,
                }
            }
        ]
    });
    
    
    //===== Isotope Project 4

    $('.container').imagesLoaded(function () {
        var $grid = $('.grid').isotope({
            // options
            transitionDuration: '1s'
        });

        // filter items on button click
        $('.portfolio-menu ul').on('click', 'li', function () {
            var filterValue = $(this).attr('data-filter');
            $grid.isotope({
                filter: filterValue
            });
        });

        //for menu active class
        $('.portfolio-menu ul li').on('click', function (event) {
            $(this).siblings('.active').removeClass('active');
            $(this).addClass('active');
            event.preventDefault();
        });
    });
    
    
    //===== slick Testimonial Four
    
    $('.testimonial-active').slick({
        dots: false,
        arrows: true,
        prevArrow: '<span class="prev"><i class="lni lni-arrow-left"></i></span>',
        nextArrow: '<span class="next"><i class="lni lni-arrow-right"></i></span>',
        infinite: true,
       autoplay: true,
        autoplaySpeed: 5000,
        speed: 800,
        slidesToShow: 1,
    });
    
    
    //====== Magnific Popup
    
    $('.video-popup').magnificPopup({
        type: 'iframe'
        // other options
    });
    
    
    //===== Magnific Popup
    
    $('.image-popup').magnificPopup({
      type: 'image',
      gallery:{
        enabled:true
      }
    });
    
    
    //===== Back to top
    
    // Show or hide the sticky footer button
    $(window).on('scroll', function(event) {
        if($(this).scrollTop() > 600){
            $('.back-to-top').fadeIn(200)
        } else{
            $('.back-to-top').fadeOut(200)
        }
    });
    
    
    //Animate the scroll to yop
    $('.back-to-top').on('click', function(event) {
        event.preventDefault();
        
        $('html, body').animate({
            scrollTop: 0,
        }, 1500);
    });
    
    
    //===== 

    function calcAge(dateString) {
        var birthday = +new Date(dateString);
        return ~~((Date.now() - birthday) / (31557600000));
      }
       
    $('#data_nascimento').on({
        blur: function() {
            var data_nascimento = $("#data_nascimento").val();
            var idade = calcAge(data_nascimento);

            if(idade >= 18){
                $(".responsavel").prop('disabled', true);
            }else{
                $(".responsavel").prop('disabled', false);
            }
        } 
    })    

    $('#ja_trabalhou').change(function (){
        var ja_trabalhou = ($(this).val());
        
        if(ja_trabalhou == "Sim"){
            $(".jovem_trabalhador").prop('disabled', false);
        }else{
            $(".jovem_trabalhador").prop('disabled', true);
        }
    });

    $('#possui_ctps').change(function (){
        var possui_ctps = ($(this).val());
        
        if(possui_ctps == "Sim"){
            $(".ctps").prop('disabled', false);
        }else{
            $(".ctps").prop('disabled', true);
        }
    });

    $('#problema_saude').change(function (){
        var problema_saude = ($(this).val());
        
        if(problema_saude == "Sim"){
            $(".problema_saude_especificacao").prop('disabled', false);
        }else{
            $(".problema_saude_especificacao").prop('disabled', true);
        }
    });

    $('#remedio_controlado').change(function (){
        var remedio_controlado = ($(this).val());
        
        if(remedio_controlado == "Sim"){
            $(".remedio_controlado_especificacao").prop('disabled', false);
        }else{
            $(".remedio_controlado_especificacao").prop('disabled', true);
        }
    });

    $('#aluno_matriculado').change(function (){
        var aluno_matriculado = ($(this).val());
        
        if(aluno_matriculado == "Sim"){
            $(".turno_matricula").prop('disabled', false);
        }else{
            swal({title: "Ops", text: "Para participar do Programa é obrigatório estar matriculado!", type: "error"});
            $(".turno_matricula").prop('disabled', true);
        }
    });
    
});