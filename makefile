up:
	docker pull 485390826234.dkr.ecr.ap-southeast-1.amazonaws.com/th3/php-dev:latest
	docker run --name twig-dev -d -v ${PWD}:/workspace 485390826234.dkr.ecr.ap-southeast-1.amazonaws.com/th3/php-dev:latest
shell:
	docker exec -it -u 1000 twig-dev bash
down:
	docker stop twig-dev && docker rm twig-dev