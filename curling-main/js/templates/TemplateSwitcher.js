const { createBlock } = wp.blocks;
const { select, subscribe, dispatch } = wp.data;

const templates = [[
    'page-standard.php', (resetBlocks, insertBlocks) => {
      const prefooterBlock = createBlock('acf/prefooter');
      const columnBlock = createBlock('cossette/block-column-2');
      const adBannerBlock = createBlock('acf/ad-banner');

      resetBlocks([
        columnBlock,
        adBannerBlock,
        prefooterBlock
      ]);
    }
  ]
];

class PageTemplateSwitcher {

  constructor() {
    this.template = null;
    this.initial = true;
  }

  init() {
    subscribe( () => {
      const newTemplate = select( 'core/editor' ).getEditedPostAttribute( 'template' );
      
      if (newTemplate !== this.template ) {

        this.template = newTemplate;
        if (!this.initial) {
          this.changeTemplate(newTemplate);
        } else {
          this.initial = false;
        }
      }

    } );

  }

  changeTemplate(newTemplate) {
    const { resetBlocks } = dispatch('core/editor');
    const { insertBlocks } = dispatch( 'core/editor' );
    // const postType = select( 'core/editor' ).getEditedPostAttribute( 'type' );
    // const id = select( 'core/editor' ).getEditedPostAttribute( 'id' );

    let insertedBlock = [];

    templates.forEach(element => {
      if (element[0] == newTemplate) {
        insertedBlock = element[1](resetBlocks, insertBlocks);
      }
    });
  }
}

new PageTemplateSwitcher().init();