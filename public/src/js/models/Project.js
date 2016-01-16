(function(){
	angular.module('Check-in').factory('Project', ['$resource', 'Design', function($resource, Design){
		var _resource = $resource(
			'/api/projects/:id/:model',
			{
				id: '@id'
			}, {
				update: {         method: 'POST' },   // /api/projects/#

				designs:       { method: 'GET',  params: { model: 'designs' }, isArray: true }, // /api/projects/#/designs
				create_design: { method: 'POST', params: { model: 'designs' }}, // /api/projects/#/designs

				comments:       { method: 'GET',  params: { model: 'comments' }, isArray: true }, // /api/projects/#/comments
				create_comment: { method: 'POST', params: { model: 'comments' }}, // /api/projects/#/comments

				requirements:       { method: 'GET',  params: { model: 'requirements' }, isArray: true }, // /api/projects/#/requirements
				create_requirement: { method: 'POST', params: { model: 'requirements' }}, // /api/projects/#/requirements
			}
		);

		function Project(data){
			angular.extend(this, data);
		}

		Project.prototype = {
			constructor: Project,

			designs: {},
			requirements: {},
			comments: {},
			
			index_designs: function(){
				var self = this;
				var promise = _resource.designs({
					id: self.id
				}).$promise;

				promise.then(function(response){
					for (var i = response.length - 1; i >= 0; i--) {
						var design = new Design(response[i]);
						design.project = self;
						self.designs[design.id] = design;
					}
				});

				return promise;
			},

			create_design: function(new_design){
				var self = this;
				var promise = _resource.create_design(new_design).$promise;

				promise.then(function(response){
					var design = new Design(response);
					design.project = self;
					self.designs[design.id] = design;
				});

				return promise;
			},

			update: function(){
				var self = this;
				var promise = _resource.update(self).$promise;
				promise.then(function(response){
					angular.extend(self, response);
				});
				return promise;
			}
		};

		return Project;
	}]);
})();