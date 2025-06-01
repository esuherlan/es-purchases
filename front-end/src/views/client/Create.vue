<template>
	<main class="app-main">
		<div class="app-content-header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-12">
						<ol class="breadcrumb float-sm-end">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Clients</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<div class="app-content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
                	<div class="card card-primary card-outline mb-4">
							<div class="card-header"><div class="card-title">Add New Client</div></div>
                     <form @submit.prevent="submitForm">
								<div class="card-body">
									<div class="mb-3">
										<label for="inputNIK" class="form-label">NIK</label>
										<input type="text" class="form-control" name="client_nik" id="client_nik" v-model="inputNik">
										<!-- <div v-if="validation.name" class="mt-2 alert alert-danger">
											{{ validation.nik[0] }}
										</div> -->
									</div>
									<div class="mb-3">
										<label for="inputName" class="form-label">Client Name</label>
										<input type="text" class="form-control" name="client_name" id="client_name" v-model="inputName">
										<!-- <div v-if="validation.name" class="mt-2 alert alert-danger">
											{{ validation.name[0] }}
										</div> -->
									</div>
									<div class="mb-3">
										<label for="selectDepartment" class="form-label">Department</label>
										<select class="form-select" v-model="selectedOption">
											<option v-for="option in options" :value="option.id" :key="option.id">
												{{ option.name }}
											</option>
										</select>
									</div>
								</div>
								<div class="card-footer">
									<button type="submit" class="btn btn-primary"><i class="nav-icon bi bi-save"></i> Save</button>
								</div>                        
                     </form>
                  </div>
              	</div>
				</div>
			</div>
		</div>
   </main>
</template>

<script>
import { onMounted, reactive, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios';

export default {
   data() {
		return {
			options: [],
			selectedOption: null,
			inputNik: '',
			inputName: ''
      };
   },
   mounted() {
      this.fetchOptions();
   },
   methods: {
		async fetchOptions() {
			try {
				const response = await axios.get('http://localhost:8000/api/department');
				this.options = response.data.data;
			} catch (error) {
				console.error('Error fetching options:', error);
			}
      },
      async submitForm() {
			try {
				await axios.post('http://localhost:8000/api/client', {
					nik: this.inputNik,
					name: this.inputName,
					department_id: this.selectedOption
				});
				this.$router.push({ name: 'client.index' });
			} catch (error) {
				console.error('Error submitting form:', error);
			}
      },
   },
};
</script>