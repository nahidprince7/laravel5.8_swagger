import Index from '../../dms/pages/Index';
import Context from '../../dms/extra_components/ContextMenu';

export default {
    mode: 'history',
    routes: [
        {
            path: '/index',
            name: 'Index',
            component: Index,
        },{
            path: '/context',
            name: 'Context',
            component: Context,
        },

    ]
};
