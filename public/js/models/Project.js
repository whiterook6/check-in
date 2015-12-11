(function(){
	angular.module('Check-in').factory('Project', ['ProjectResource', 'Design', function(ProjectResource, Design){
		Project = function(model){
			angular.extend(this, model);
		};

		Project.prototype = {
			constructor: Project,

			save: function(){
				var promise = ProjectResource.update(this).$promise;
				promise.then(function(response){
					debugger;
				});

				return promise;
			},

			delete: function(){
				var promise = ProjectResource.delete({ // needed because otherwise the whole object is sent via query parameters, since DELETE doesn't post-param things like POST.
					id: this.id
				}).$promise;
				
				promise.then(function(response){
					debugger;
				});

				return promise;
			},

			load_designs: function(){
				var promise = ProjectResource.designs({
					id: this.id
				}).$promise;
				this.designs = {};

				promise.then(function(response){
					debugger;
					// for (var i = response.length - 1; i >= 0; i--) {
					// 	var design = new Design(response[i], this);
					// 	this.designs[design.id] = design;
					// };
				});

				return promise;
			},

			create_design: function(name){
				var promise = ProjectResource.create_design({
					name: name
				}).$promise;

				promise.then(function(response){
					debugger;
					// var design = new Design(response[i], this);
					// this.designs[design.id] = design;
				});

				return promise;
			}
		};

		return Project;
	}]);
})();