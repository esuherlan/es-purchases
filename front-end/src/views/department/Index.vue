<template>
	<main class="app-main">
		<div class="app-content-header">
			<div class="container-fluid">
				<div class="row">
				<div class="col-sm-6"><h3 class="mb-0">Department</h3></div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-end">
						<li class="breadcrumb-item"><a href="#">Home</a></li>
						<li class="breadcrumb-item active" aria-current="page">Department</li>
					</ol>
				</div>
				</div>
			</div>
		</div>
		<div class="app-content">
			<div class="container-fluid">
				<div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <router-link :to="{name: 'department.create'}" class="btn btn-md btn-success"><i class="nav-icon bi bi-plus-circle"></i> Add New Department</router-link>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">#</th>
                                            <th>Name</th>
                                            <th style="width: 200px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="align-middle" v-for="(department, index) in departments" :key="index">
                                            <td>{{ index+1 }}</td>
                                            <td>{{ department.name }}</td>
                                            <td>
                                                <router-link :to="{name: 'department.edit', params:{id: department.id }}" class="btn btn-sm btn-primary mr-2"><i class="nav-icon bi bi-pencil"></i> Edit</router-link>
                                                <button class="btn btn-sm btn-danger ml-1"><i class="nav-icon bi bi-trash"></i> Delete</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import axios from 'axios'
import { onMounted, ref } from 'vue'

export default {

    setup() {
        let departments = ref([])

        onMounted(() => {
            axios.get('http://localhost:8000/api/department')
            .then(response => {
                departments.value = response.data.data
            }).catch(error => {
                console.log(error.response.data)
            })
        })

        return {
            departments
        }
    }
}
</script>