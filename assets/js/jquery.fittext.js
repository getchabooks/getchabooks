$.fn.fitText = function(desiredHeight) {
    var font;

    return this.each(function()
    {   
        font = parseFloat($(this).css('font-size'));
        if(!desiredHeight) {
            while($(this).scrollHeight > $(this).clientHeight) {
                // alert($(this).scrollHeight);
                updateFont();
                $(this).css('font-size',font);
            }
            // TODO: FIX COMPRESSOR TO NOT NEED THIS
            true;
        } else {
            while($(this).outerHeight() > desiredHeight) {
                updateFont();
                $(this).css('font-size',font);
            }
            // TODO: FIX COMPRESSOR TO NOT NEED THIS
            true;
        }
    }); 
    
    function updateFont() {
        font *= 0.9;
    }  
}
