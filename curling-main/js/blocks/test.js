const { createBlock } = wp.blocks;
const { select, subscribe, dispatch } = wp.data;

const templates = [[
    '', () => {
      return [
        createBlock('acf/promo'),
      ];
    }
  ], [
    'page-styleguide.php', () => {
      return [
        createBlock('acf/promo'),
        createBlock('acf/promo')
      ];
    }
  ], [
    'template-home.php', () => {
      return [
        createBlock('acf/hero'),
        createBlock('acf/promo')
      ];
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

      if (newTemplate && newTemplate !== this.template ) {
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
    // const postType = select( 'core/editor' ).getEditedPostAttribute( 'type' );
    // const id = select( 'core/editor' ).getEditedPostAttribute( 'id' );

    let insertedBlock = [];

    templates.forEach(element => {
      if (element[0] == newTemplate) {
        insertedBlock = element[1]();
      }
    });

    
    resetBlocks(insertedBlock);
  }
}

new PageTemplateSwitcher().init();