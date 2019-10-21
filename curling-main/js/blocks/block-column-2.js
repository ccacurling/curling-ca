const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { InspectorControls, InnerBlocks } = wp.editor;
const { SelectControl, CheckboxControl } = wp.components;
const { createElement } = wp.element;
const { withDispatch } = wp.data;

const TEMPLATE2 = [
	['core/columns', {
    columns: 2
  }, [
		['core/column', {
      placeholder: 'Enter Content'
    }],
		['core/column', {
      placeholder: 'Enter Content'
    }]
	]
]];

registerBlockType("cossette/block-column-2", {
  title: "Two Column Block",
  icon: (
    <svg
      width="24px"
      height="24px"
      viewBox="0 0 24 24"
      version="1.1"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        d="M19,0 L1,0 L0,1 L0,15 L1,16 L19,16 L20,15 L20,1 L19,0 Z M9,14 L2,14 L2,2 L9,2 L9,14 Z M18,14 L11,14 L11,2 L18,2 L18,14 Z"
      />
    </svg>
  ),
  category: "common",
  attributes: {
    type: {
      default: '50_50',
      type: "string"
    },
    is_fullwidth: {
      default: false,
      type: "boolean"
    },
    left_column_is_sidebar: {
      default: false,
      type: "boolean"
    },
    nopadding: {
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
              value={attributes.left_column_is_sidebar}
              label={__('Right Column is Sidebar')}
              checked={attributes.left_column_is_sidebar}
              onChange={(left_column_is_sidebar) => {
                setAttributes({
                  left_column_is_sidebar
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
            <h3>Column Type</h3>
            <SelectControl 
              value={attributes.type} 
              options={[
                { label: '50/50', value: '50-50' },
                { label: '25/75', value: '25-75' },
                { label: '33/66', value: '33-66' },
                { label: '66/33', value: '66-33' },
                { label: '75/25', value: '75-25' },
                { label: '84/16', value: '84-16' }
              ]}
              onChange={(type) => {
                setAttributes({type});
              }}
            />
          </div>
        </InspectorControls>,
        <div className={className}>
          <InnerBlocks template={TEMPLATE2} templateLock="all" />
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
