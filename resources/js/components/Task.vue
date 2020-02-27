<template>
	<div class="row">
		<div class="col-3" v-for="statu in status">
			<h3 class="text-capitalize">{{ statu.name }}</h3>
			<draggable class="list-group" :list="statu.tasks" group="statu.tasks" @add="add(statu.id)" @change="log">
				<div
					class="list-group-item"
					v-for="(task, index) in statu.tasks"
					:key="task.id"
				>
					<Model :task="task"/>
				</div>
				<div v-if="isadd==statu.id">
					<textarea name="" id="" cols="30" class="form-control" rows="2" v-on:keyup.enter="submit"></textarea>
				</div>
				<button slot="footer" @click="addPeople(statu.id)">Add</button>
			</draggable>
		</div>
	</div>
</template>
<script>
import draggable from "vuedraggable";
import axios from 'axios';
export default {
	name: "two-lists",
	display: "Two Lists",
	order: 1,
	components: {
		draggable
	},
	data() {
		return {
			status:[],
			statu1:[],
			status_id:0,
			isadd:false,
			element:[]
		};
	},
	methods: {
		addPeople(id){
			console.log();
			this.isadd=id;
		},
		submit(e){
			var self = this;
			console.log(this.status);
			console.log(e.target.value.length);
			if(e.target.value.length>3){
				console.log(this.isadd);
				axios.post('api/task/create',{
					status_id:this.isadd,
					task_name:e.target.value,
				}).then((res)=>{
					self.status.find(function(element) {
						if(element.id==res.data.status_id){
							element.tasks.push(res.data)
						}
					});
					console.log(res.data);
				})
				this.isadd=false
			}
		},
		abc(element){
			console.log(element);
		},
		add: function(status_id) {
			axios.post('api/update',{
				task_id:this.element.element.id,
				status_id:status_id,
			}).then((res)=>{
				console.log(res);
			})
		},
		replace: function() {
			this.list = [{ name: "Edgard" }];
		},
		clone: function(el) {
			return {
				name: el.name + " cloned"
			};
		},
		log: function(evt) {
			if(evt.added!=undefined){
				this.element=evt.added;
			}
		}
	},
	created(){
		var self = this;
		axios.get('api/tasks').then((red)=>{
			self.status=red.data
		})
	}
};
</script>
<style>
	.modal-backdrop{
		    opacity: .1!important;
	}
</style>