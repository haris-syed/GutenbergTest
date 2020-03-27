/* This section of the code registers a new block, sets an icon and a category, and indicates what type of fields it'll include. */
wp.blocks.registerBlockType('magik-builder/timer', {
    title: 'Timer',
    icon: 'clock',
    category: 'magik-blocks',
    attributes: {
        content: {type: 'string'},
        color: {type: 'string'}
    },

    /* This configures how the content and color fields will work, and sets up the necessary elements */

    edit: function(props) {
        function updateContent(event) {
            props.setAttributes({content: event.target.value})
        }
        function updateColor(value) {
            props.setAttributes({color: value.hex})
        }
        return React.createElement("table", {
            class: "time-widget",
            cellspacing: "0"
        }, React.createElement("tbody", null,
            React.createElement("tr", null, 
                React.createElement("td", {
                    class: "tw-digit",
                    align: "center"
                    }, "10"),
                React.createElement("td", {
                    class: "tw-digit",
                    align: "center"
                    }, "10"),
                React.createElement("td", {
                    class: "tw-digit",
                    align: "center"
                    }, "10"),
                React.createElement("td", {
                    class: "tw-digit",
                    align: "center"
                    }, "10")),
            React.createElement("tr", null, 
                React.createElement("td", {
                    class: "tw-title",
                    align: "center"
                    }, "days"),
                React.createElement("td", {
                    class: "tw-title",
                    align: "center"
                    }, "hours"),
                React.createElement("td", {
                    class: "tw-title",
                    align: "center"
                    }, "minutes"),
                React.createElement("td", {
                    class: "tw-title",
                    align: "center"
                    }, "seconds"))));
    },
    save: function(props) {
        return wp.element.createElement(
            "h3",
            {style: { border: "3px solid " + props.attributes.color } },
        props.attributes.content
    );
    }
})