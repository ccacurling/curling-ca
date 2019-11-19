console.log("Guten Script Loaded");

function addListBlockClassName( settings, name ) {
    if ( name !== 'core/list' ) {
        return settings;
    }
 
    return lodash.assign( {}, settings, {
        supports: lodash.assign( {}, settings.supports, {
            className: true
        } ),
    } );
}
 
wp.hooks.addFilter(
    'blocks.registerBlockType',
    'my-plugin/class-names/list-block',
    addListBlockClassName
);