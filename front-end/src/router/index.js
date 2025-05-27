//import vue router
import { createRouter, createWebHistory } from 'vue-router'

//define a routes
const routes = [
	{
		path: '/',
		name: 'dashboard.index',
		component: () => import( /* webpackChunkName: "dashboard.index" */ '@/views/dashboard/Index.vue')
	},
	{
		path: '/department',
		name: 'department.index',
		component: () => import( /* webpackChunkName: "department.index" */ '@/views/department/Index.vue')
	},
	{
		path: '/department/create',
		name: 'department.create',
		component: () => import( /* webpackChunkName: "department.create" */ '@/views/department/Create.vue')
	},
	{
		path: '/department/edit/:id',
		name: 'department.edit',
		component: () => import( /* webpackChunkName: "department.edit" */ '@/views/department/Edit.vue')
	}
]

//create router
const router = createRouter({
	history: createWebHistory(),
	routes  // config routes
})

export default router