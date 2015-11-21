(function(){
	angular
		.module('Check-in', ['ngResource'])
		
		.factory('Projects', ['$resource', function($resource){
			var resource = $resource(
				'/api/projects/:id',
				{
					id: '@id'
				}, {
					list: { method: 'GET' },     // /api/projects
					create: { method: 'POST' },  // /api/projects 
					get: { method: 'GET' },      // /api/projects/#
					update: { method: 'POST' },  // /api/projects/# 
					delete: { method: 'DELETE' } // /api/projects/# 
				}
			);

			resource.save = function(project){
				if (project.id){
					return this.update(project);
				} else{
					return this.create(project);
				}
			};

			return resource;
		}])
		.factory('Designs', ['$resource', function($resource){
			var resource = $resource(
				'/api/designs/:id',
				{
					id: '@id'
				}, {
					get: { method: 'GET' },      // /api/designs/#
					update: { method: 'POST' },  // /api/designs/#
					delete: { method: 'DELETE' } // /api/designs/#
				}
			);

			return resource;
		}])
		.factory('Versions', ['$resource', function($resource){
			var resource = $resource(
				'/api/versions/:id',
				{
					id: '@id'
				}, {
					get: { method: 'GET' },      // /api/versions/#
					update: { method: 'POST' },  // /api/versions/#
					delete: { method: 'DELETE' } // /api/versions/#
				}
			);

			return resource;
		}])
		.factory('ProjectDesigns', ['$resource', function($resource){
			var resource = $resource(
				'/api/projects/:project_id/designs',
				{
					project_id: '@project_id',
					design_id: '@design_id',
				}, {
					list: { method: 'GET' },   // /api/projects/#/designs
					append: { method: 'POST' } // /api/projects/#/designs
				}
			);

			return resource;
		}])
		.factory('DesignVersions', ['$resource', function($resource){
			var resource = $resource(
				'/api/designs/:design_id/versions',
				{
					design_id: '@design_id',
					version_id: '@version_id',
				}, {
					list: { method: 'GET' },   // /api/designs/#/versions
					append: { method: 'POST' } // /api/designs/#/versions
				}
			);

			return resource;
		}])
		.controller('CheckinController', [function(){
			var ctrl = this;
		}]);
})();
