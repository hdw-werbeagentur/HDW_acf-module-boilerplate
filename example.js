const example = {
    boot: function() {
        example.moduleWrapper = jQuery('.js-example');
        example.bindings();
    },

    bindings: function() {
        example.moduleWrapper.on( "click", function(e) {
            e.preventDefault();
            example.exampleFunction( this );
        });
    },

    exampleFunction: function( element ) {
        console.log(element)
    },
};

jQuery(function() {
    example.boot();
});