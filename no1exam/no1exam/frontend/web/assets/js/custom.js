$(document).ready(function(){
    $('.carousel[data-type="multi"] .item').each(function(){
      var next = $(this).next();
      if (!next.length) {
        next = $(this).siblings(':first');
      }
      next.children(':first-child').clone().appendTo($(this));
      
      for (var i=0;i<2;i++) {
        next=next.next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }                
        next.children(':first-child').clone().appendTo($(this));
      }              
    });

    // Slider Script :: START
    $('.carousel').carousel({
          interval: 6000,
          pause: "false"
        });

    //Tabs Script :: START
    $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
            e.preventDefault();
            $(this).siblings('a.active').removeClass("active");
            $(this).addClass("active");
            var index = $(this).index();
            $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
            $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
        });

    // Mouse Handler
    function mouseHandler(e){
          // Add Picked Class
          if ($(this).hasClass('picked')) {
            $(this).removeClass('picked');
          } else {
            $(".picked").removeClass('picked');
            $(this).addClass('picked');
          } 
        }
        
        function start(){
          // Bind all li
          $('.gmtype li').bind('click', mouseHandler);
        }
        
        $(document).ready(start);
    });