<template>
	<div class="content-wrapper">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-12">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="#">Home</a></li>
							<li class="breadcrumb-item active">Departments</li>
						</ol>
					</div>
				</div>
			</div>
		</section>
		<section class="content">
      	<div class="container-fluid">
       	 	<div class="row">
					<div class="col-md-12">
						<div class="card card-primary card-outline">
							<div class="card-header"><div class="card-title">Add New Purchase</div></div>
                     <form @submit.prevent="submitForm">
								<div class="card-body">
									<div class="row">
										<div class="col-md-4">
											<div class="mb-3">
												<label for="selectDepartment" class="form-label">NIK Peminta</label>
												<select class="form-select" v-model="selectedOption" @change="getClientDetail">
													<option v-for="option in options" :value="option.id" :key="option.id">
														{{ option.nik }}
													</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="mb-3">
												<label for="inputNIK" class="form-label">Nama</label>
												<input type="text" class="form-control" v-model="clientDetail.name" disabled>
											</div>
										</div>
										<div class="col-md-4">
											<div class="mb-3">
												<label for="inputName" class="form-label">Departemen</label>
												<input type="text" class="form-control" v-model="clientDetail.department_name" disabled>
											</div>
										</div>
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
		</section>
	</div>
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
			inputName: '',
			clientDetail: {
				name: '',
				department_name: '',
			},
      };
   },
   mounted() {
      this.fetchOptions();
   },
   methods: {
		async fetchOptions() {
			try {
				const response = await axios.get('http://localhost:8000/api/client');
				this.options = response.data.data;
			} catch (error) {
				console.error('Error fetching options:', error);
			}
      },
		async getClientDetail() {
			try {
				const resClientDetail = await axios.get(`http://localhost:8000/api/client/${this.selectedOption}`);
				this.clientDetail = resClientDetail.data.data[0]
			} catch (error) {
				console.error('Error fetching data:', error);
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