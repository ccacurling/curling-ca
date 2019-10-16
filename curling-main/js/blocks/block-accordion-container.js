const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { TextControl, Button, Panel, PanelBody, PanelRow } = wp.components;
const { InnerBlocks } = wp.editor;
const { createElement } = wp.element;
const { withDispatch } = wp.data;

registerBlockType("cossette/block-accordion-container", {
  title: "Accordion Container",
  icon: (
    <svg
      width="72px"
      height="78px"
      viewBox="0 0 72 78"
      version="1.1"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        d="M37.73,77.157 C37.73,77.157 37.104,61.815 37.104,60.289 C37.104,58.752 38.412,58.232 39.969,58.56 C41.547,58.907 56.198,61.815 56.198,61.815 C56.198,61.815 55.08,58.712 54.294,56.41 C53.521,54.106 54.536,53.698 55.08,53.228 L71.451,39.348 L68.857,38.099 C67.29,37.388 67.542,36.093 67.783,35.239 L70.624,25.416 C70.624,25.416 63.802,26.927 62.202,27.16 C60.939,27.356 60.501,26.778 60.104,25.919 L58.056,21.15 L49.499,30.371 C47.889,31.803 46.333,30.708 46.626,29.03 C46.899,27.505 50.909,9.377 50.909,9.377 C50.909,9.377 46.481,11.969 45.006,12.828 C43.549,13.681 42.766,13.544 41.987,12.164 C41.205,10.764 35.718,7.10542736e-15 35.718,7.10542736e-15 C35.718,7.10542736e-15 30.239,10.764 29.46,12.164 C28.676,13.544 27.898,13.681 26.431,12.828 C24.964,11.969 20.529,9.377 20.529,9.377 C20.529,9.377 24.556,27.505 24.823,29.03 C25.116,30.708 23.554,31.803 21.938,30.371 L13.388,21.15 L11.341,25.919 C10.949,26.778 10.51,27.356 9.235,27.16 C7.642,26.927 0.538,25.416 0.538,25.416 L3.661,35.239 C3.907,36.093 4.147,37.388 2.585,38.099 L7.10542736e-15,39.348 L16.365,53.228 C16.909,53.698 17.932,54.106 17.148,56.41 C16.365,58.712 15.248,61.815 15.248,61.815 C15.248,61.815 29.905,58.907 31.468,58.56 C33.034,58.232 34.345,58.752 34.345,60.289 C34.345,61.815 33.714,77.157 33.714,77.157 L37.73,77.157"
        id="Fill-7"
      />
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