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
				<button slot="footer" @click="addPeople">Add</button>
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
			element:[]
		};
	},
	methods: {
		addPeople(){
			console.log();
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