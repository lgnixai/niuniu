import type { RouterConfig } from '@nuxt/schema'
import routes from '@/app/pages/routes'

//const addonRoutes = import.meta.glob('@/addon/**/pages/routes.ts')
const addonRoutes = import.meta.glob('@/addon/**/pages/routes.ts', { eager: true });

for (const key in addonRoutes) {
    const addon = key.split('/')[2]
    routes.push(...addonRoutes[key].default.map((item) => {
        item.meta = item.meta ? Object.assign(item.meta, { addon }) : { addon }
        return item
    }))
}

// https://router.vuejs.org/api/interfaces/routeroptions.html
export default <RouterConfig>{
    routes: (_routes) => routes,
    strict: false
}
