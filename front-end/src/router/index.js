import { createRouter, createWebHistory } from 'vue-router'

const Dashboard = () => import('@/views/dashboard/Index.vue')

const DepartmentIndex = () => import('@/views/department/Index.vue')
const DepartmentCreate = () => import('@/views/department/Create.vue')
const DepartmentEdit = () => import('@/views/department/Edit.vue')

const ClientIndex = () => import('@/views/client/Index.vue')
const ClientCreate = () => import('@/views/client/Create.vue')
const ClientEdit = () => import('@/views/client/Edit.vue')

const PurchaseIndex = () => import('@/views/purchase/Index.vue')
const PurchaseCreate = () => import('@/views/purchase/Create.vue')
const PurchaseEdit = () => import('@/views/purchase/Edit.vue')

const ProductIndex = () => import('@/views/product/Index.vue')
const ProductCreate = () => import('@/views/product/Create.vue')
const ProductEdit = () => import('@/views/product/Edit.vue')

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
	},
	{
		path: '/purchase',
		name: 'purchase.index',
		component: PurchaseIndex
	},
	{
		path: '/purchase/create',
		name: 'purchase.create',
		component: PurchaseCreate
	},
	{
		path: '/purchase/edit/:id',
		name: 'purchase.edit',
		component: PurchaseEdit
	},
	{
		path: '/product',
		name: 'product.index',
		component: ProductIndex
	},
	{
		path: '/product/create',
		name: 'product.create',
		component: ProductCreate
	},
	{
		path: '/product/edit/:id',
		name: 'product.edit',
		component: ProductEdit
	}
]

const router = createRouter({
	history: createWebHistory(),
	routes
})

export default router