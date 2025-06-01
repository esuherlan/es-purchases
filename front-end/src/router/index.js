import { createRouter, createWebHistory } from 'vue-router'

const Dashboard = () => import('@/views/dashboard/Index.vue')

const DepartmentIndex = () => import('@/views/department/Index.vue')
const DepartmentCreate = () => import('@/views/department/Create.vue')
const DepartmentEdit = () => import('@/views/department/Edit.vue')

const ClientIndex = () => import('@/views/client/Index.vue')
const ClientCreate = () => import('@/views/client/Create.vue')
const ClientEdit = () => import('@/views/client/Edit.vue')

const routes = [
	{
		path: '/',
		name: 'dashboard.index',
		component: Dashboard
	},
	{
		path: '/department',
		name: 'department.index',
		component: DepartmentIndex
	},
	{
		path: '/department/create',
		name: 'department.create',
		component: DepartmentCreate
	},
	{
		path: '/department/edit/:id',
		name: 'department.edit',
		component: DepartmentEdit
	},
	{
		path: '/client',
		name: 'client.index',
		component: ClientIndex
	},
	{
		path: '/client/create',
		name: 'client.create',
		component: ClientCreate
	},
	{
		path: '/client/edit/:id',
		name: 'client.edit',
		component: ClientEdit
	}
]

const router = createRouter({
	history: createWebHistory(),
	routes
})

export default router