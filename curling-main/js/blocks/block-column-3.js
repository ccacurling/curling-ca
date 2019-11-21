const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InspectorControls, InnerBlocks } = wp.editor;
const { SelectControl, CheckboxControl } = wp.components;
const { createElement } = wp.element;
const { withDispatch } = wp.data;

const TEMPLATE3 = [
	['core/columns', {
    columns: 3
  },[
		['core/column', {
      placeholder: 'Enter Content'
    }],
		['core/column', {
      placeholder: 'Enter Content'
    }],
		['core/column', {
      placeholder: 'Enter Content'
    }]
	]
]];

registerBlockType("cossette/block-column-3", {
  title: "Three Column Block",
  icon: (
    <svg
      width="24px"
      height="24px"
      viewBox="0 0 24 24"
      version="1.1"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        d="M19,0 L1,0 L0,1 L0,15 L1,16 L19,16 L20,15 L20,1 L19,0 Z M6,14 L2,14 L2,2 L6,2 L6,14 Z M12,14 L8,14 L8,2 L12,2 L12,14 Z M18,14 L14,14 L14,2 L18,2 L18,14 Z"
      />
    </svg>
  ),
  category: "common",
  attributes: {
    is_fullwidth: {
      default: true,
      type: "boolean"
    },
    nopadding : {
      default: false,
      type: "boolean"
    },
    equalheight: {
      default: false,
      type: "boolean"
    }
  },
  // TODO: This is a hack which forces the template to appear valid.
  // See https://github.com/WordPress/gutenberg/issues/11681
  edit: 
  // withDispatch(dispatch => {
  //   dispatch('core/editor').setTemplateValidity(true);
  // })(
    ({ className, setAttributes, attributes }) => {
    return [
        <InspectorControls>
          <div>
            <CheckboxControl
              value={attributes.is_fullwidth}
              label={__('Full Width')}
              checked={attributes.is_fullwidth}
              onChange={(is_fullwidth) => {
                setAttributes({
                  is_fullwidth
                });
              }}
            />
            <CheckboxControl
              value={attributes.nopadding}
              label={__('No Padding')}
              checked={attributes.nopadding}
              onChange={(nopadding) => {
                setAttributes({
                  nopadding
                });
              }}
            />
            <CheckboxControl
              value={attributes.equalheight}
              label={__('Equal Height')}
              checked={attributes.equalheight}
              onChange={(equalheight) => {
                setAttributes({
                  equalheight
                });
              }}
            />
          </div>
        </InspectorControls>,
        <div className={className}>
          <InnerBlocks template={TEMPLATE3} templateLock="all" />
        </div>
    ];
  },
  // ),

  save: ({attributes}) => {
    return (
      <div>
        { attributes.content }
        <InnerBlocks.Content />
      </div>
    );
  }
});
