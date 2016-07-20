<!--<html>-->
<!--<head>-->
<!--    <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>-->
<!--    <script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>-->
<!--    <script src="//raw.github.com/botmonster/jquery-bootpag/master/lib/jquery.bootpag.min.js"></script>-->
<!--    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">-->
<!--</head>-->
<!--<body>-->
<!--<div id="content">Dynamic Content goes here</div>-->
<!--<div id="page-selection">Pagination goes here</div>-->
<!--<script>-->
<!--    // init bootpag-->
<!--    $('#page-selection').bootpag({-->
<!--        total: 10-->
<!--    }).on("page", function (event, /* page number here */ num) {-->
<!--        $("#content").html("Insert content"); // some ajax content loading...-->
<!--    });-->
<!--</script>-->
<!--</body>-->
<!--</html>-->

<!--<!doctype html>-->
<!--<html lang="en">-->
<!--<head>-->
<!--    <meta charset="utf-8">-->
<!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
<!--    <title>jQuery UI Accordion - Collapse content</title>-->
<!--    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">-->
<!--    <link rel="stylesheet" href="/resources/demos/style.css">-->
<!--    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<!--    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>-->
<!--    <script>-->
<!--        $( function() {-->
<!--            $( "#accordion" ).accordion({-->
<!--                collapsible: true-->
<!--            });-->
<!--        } );-->
<!--    </script>-->
<!--</head>-->
<!--<body>-->
<!---->
<!--<div id="accordion">-->
<!--    <h3>Section 1</h3>-->
<!--    <div>-->
<!--        <p>Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.</p>-->
<!--    </div>-->
<!--    <h3>Section 2</h3>-->
<!--    <div>-->
<!--        <p>Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna. </p>-->
<!--    </div>-->
<!--    <h3>Section 3</h3>-->
<!--    <div>-->
<!--        <p>Nam enim risus, molestie et, porta ac, aliquam ac, risus. Quisque lobortis. Phasellus pellentesque purus in massa. Aenean in pede. Phasellus ac libero ac tellus pellentesque semper. Sed ac felis. Sed commodo, magna quis lacinia ornare, quam ante aliquam nisi, eu iaculis leo purus venenatis dui. </p>-->
<!--        <ul>-->
<!--            <li>List item one</li>-->
<!--            <li>List item two</li>-->
<!--            <li>List item three</li>-->
<!--        </ul>-->
<!--    </div>-->
<!--    <h3>Section 4</h3>-->
<!--    <div>-->
<!--        <p>Cras dictum. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aenean lacinia mauris vel est. </p><p>Suspendisse eu nisl. Nullam ut libero. Integer dignissim consequat lectus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. </p>-->
<!--    </div>-->
<!--</div>-->
<!---->
<!---->
<!--</body>-->
<!--</html>-->


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery UI Tabs - Simple manipulation</title>
    
    <script>
        $( function() {
            var tabTitle = $( "#tab_title" ),
                tabContent = $( "#tab_content" ),
                tabTemplate = "<li><a href='#{href}'>#{label}</a> <span class='ui-icon ui-icon-close' role='presentation'>Remove Tab</span></li>",
                tabCounter = 2;

            var tabs = $( "#tabs" ).tabs();

            // Modal dialog init: custom buttons and a "close" callback resetting the form inside
            var dialog = $( "#dialog" ).dialog({
                autoOpen: false,
                modal: true,
                buttons: {
                    Add: function() {
                        addTab();
                        $( this ).dialog( "close" );
                    },
                    Cancel: function() {
                        $( this ).dialog( "close" );
                    }
                },
                close: function() {
                    form[ 0 ].reset();
                }
            });

            // AddTab form: calls addTab function on submit and closes the dialog
            var form = dialog.find( "form" ).on( "submit", function( event ) {
                addTab();
                dialog.dialog( "close" );
                event.preventDefault();
            });

            // Actual addTab function: adds new tab using the input from the form above
            function addTab() {
                var label = tabTitle.val() || "Tab " + tabCounter,
                    id = "tabs-" + tabCounter,
                    li = $( tabTemplate.replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) ),
                    tabContentHtml = tabContent.val() || "Tab " + tabCounter + " content.";

                tabs.find( ".ui-tabs-nav" ).append( li );
                tabs.append( "<div id='" + id + "'><p>" + tabContentHtml + "</p></div>" );
                tabs.tabs( "refresh" );
                tabCounter++;
            }

            // AddTab button: just opens the dialog
            $( "#add_tab" )
                .button()
                .on( "click", function() {
                    dialog.dialog( "open" );
                });

            // Close icon: removing the tab on click
            tabs.on( "click", "span.ui-icon-close", function() {
                var panelId = $( this ).closest( "li" ).remove().attr( "aria-controls" );
                $( "#" + panelId ).remove();
                tabs.tabs( "refresh" );
            });

            tabs.on( "keyup", function( event ) {
                if ( event.altKey && event.keyCode === $.ui.keyCode.BACKSPACE ) {
                    var panelId = tabs.find( ".ui-tabs-active" ).remove().attr( "aria-controls" );
                    $( "#" + panelId ).remove();
                    tabs.tabs( "refresh" );
                }
            });
        } );
    </script>
</head>
<body>

<div id="dialog" title="Tab data">
    <form>
        <fieldset class="ui-helper-reset">
            <label for="tab_title">Title</label>
            <input type="text" name="tab_title" id="tab_title" value="Tab Title" class="ui-widget-content ui-corner-all">
            <label for="tab_content">Content</label>
            <textarea name="tab_content" id="tab_content" class="ui-widget-content ui-corner-all">Tab content</textarea>
        </fieldset>
    </form>
</div>

<button id="add_tab">Add Tab</button>

<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Nunc tincidunt</a> <span class="ui-icon ui-icon-close" role="presentation">Remove Tab</span></li>
    </ul>
    <div id="tabs-1">
        <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus. Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
    </div>
</div>


</body>
</html>
