const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { TextControl, Button, Panel, PanelBody, PanelRow } = wp.components;
const { InnerBlocks } = wp.editor;
const { createElement } = wp.element;
const { withDispatch } = wp.data;

registerBlockType("cossette/block-accordion-container", {
  title: "Accordion Container",
  icon: (
    <svg width="20px" height="12px" viewBox="0 0 20 12" version="1.1" xmlns="http://www.w3.org/2000/svg">
        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
            <g id="test" transform="translate(0.000000, -2.000000)" fill="#000000" fill-rule="nonzero">
                <path d="M15.5,9.01709605 L17,7 L14,7 L15.5,9.01709605 Z M19,2 L1,2 L0,2.75 L0,13.25 L1,14 L19,14 L20,13.25 L20,2.75 L19,2 Z M18,12 L2,12 L2,4 L18,4 L18,12 Z"></path>
            </g>
        </g>
    </svg>
  ),
  category: "common",
  attributes: {
    title: {
      default: '',
      type: "string"
    },
    show_label: {
      default: "Show",
      type: "string"
    },
    hide_label: {
      default: "Hide",
      type: "string"
    },
    is_single_item: {
      default: false,
      type: "boolean"
    },
    additional_link_title: {
      default: "",
      type: 'string'
    },
    additional_link_url: {
      default: "",
      type: 'string'
    },
    additional_link_target: {
      default: "",
      type: 'string'
    }
  },
  // TODO: This is a hack which forces the template to appear valid.
  // See https://github.com/WordPress/gutenberg/issues/11681
  edit: withDispatch(dispatch => {
    dispatch('core/editor').setTemplateValidity(true);
  })(({ className, setAttributes, attributes }) => {

    return (
      <div className={className}>
        <InspectorControls>
          <div>
            <TextControl
              value={attributes.title}
              label={__('Title')}
              checked={attributes.title}
              onChange={(title) => {
                setAttributes({
                  title
                });
              }}
            />
            <TextControl
              value={attributes.show_label}
              label={__('Show Label')}
              checked={attributes.show_label}
              onChange={(show_label) => {
                setAttributes({
                  show_label
                });
              }}
            />
            <TextControl
              value={attributes.hide_label}
              label={__('Hide Label')}
              checked={attributes.hide_label}
              onChange={(hide_label) => {
                setAttributes({
                  hide_label
                });
              }}
            />
            <CheckboxControl
              value={attributes.is_single_item}
              label={__('Simple Style')}
              checked={attributes.is_single_item}
              onChange={(is_single_item) => {
                setAttributes({
                  is_single_item
                });
              }}
            />
            <Panel
              header={__("Additional Link:")}
            >
              <TextControl
                value={attributes.additional_link_title}
                label={__('Title')}
                onChange={(additional_link_title) => {
                  setAttributes({
                    additional_link_title
                  });
                }}
              />
              <TextControl
                value={attributes.additional_link_url}
                label={__('URL')}
                onChange={(additional_link_url) => {
                  setAttributes({
                    additional_link_url
                  });
                }}
              />
              <TextControl
                value={attributes.additional_link_target}
                label={__('Target')}
                onChange={(additional_link_target) => {
                  setAttributes({
                    additional_link_target
                  });
                }}
              />
            </Panel>
          </div>
        </InspectorControls>
        <InnerBlocks templateLock={false} />
      </div>
    );
  }),

  save: ({className, attributes}) => {
    return (
      <div>
        { attributes.content }
        <InnerBlocks.Content />
      </div>
    );
  }
});

function _cloneArray(arr) {
  if (Array.isArray(arr)) {
      for (var i = 0, arr2 = Array(arr.length); i < arr.length; i++) {
          arr2[i] = arr[i];
      }
      return arr2;
  } else {
      return Array.from(arr);
  }
}
