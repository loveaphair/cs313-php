$(function(){

    $('.clicky-areas').on("click", "div", function(){
      alert("Clicked!");
    });

    $('#color_submit').click(function(){
      var color = $('#first_div_color_selector').val();
      $('.clicky-areas div').first().css("background-color", color);
    });

    $('#hide_div').click(function(){
      $('.clicky-areas div:nth-child(3)').fadeToggle("slow", "linear");
      $(this).toggleClass('divHidden');

      if($(this).hasClass('divHidden')){
        $('.hide-div-text').text("Make the third div come back ");
        $(this).val('Show div!');
      }else{
        $('.hide-div-text').text("Make the third div go away ");
        $(this).val('Hide div!');
      }
      
    })

  });