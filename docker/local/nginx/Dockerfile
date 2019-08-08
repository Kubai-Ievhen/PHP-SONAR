FROM ubuntu:14.04

# Install.
RUN \
  sed -i 's/# \(.*multiverse$\)/\1/g' /etc/apt/sources.list && \
  apt-get update && \
  apt-get -y upgrade && \
  apt-get install -y build-essential && \
  apt-get install -y software-properties-common && \
  apt-get install -y byobu curl htop man unzip vim wget git && \
  apt-get install -y libpcre3 libpcre3-dev && \
  apt-get install -y --reinstall zlibc zlib1g zlib1g-dev && \
  rm -rf /var/lib/apt/lists/*

# Set environment variables.
ENV LUA_JIT_VERSION '2.0.5'
ENV NGINX_DEVEL_KIT_VERSION '0.3.0'
ENV LUA_MODULE_VERSION '0.10.13'
ENV NGINX_VERSION '1.15.2'

WORKDIR /application

RUN mkdir -p /var/cache/nginx/scgi_temp && \
		mkdir -p /var/cache/nginx/uwsgi_temp && \
		mkdir -p /var/cache/nginx/fastcgi_temp && \
		mkdir -p /var/cache/nginx/proxy_temp && \
		mkdir -p /var/cache/nginx/client_temp && \
		mkdir -p /var/log/nginx && \
		touch  /var/log/nginx/access.log && \
		touch  /var/log/nginx/error.log

# Install Lua JIT
RUN wget http://luajit.org/download/LuaJIT-${LUA_JIT_VERSION}.tar.gz && \
 	tar xvzf LuaJIT-${LUA_JIT_VERSION}.tar.gz && \
 	rm LuaJIT-${LUA_JIT_VERSION}.tar.gz && \
 	mv ./LuaJIT-${LUA_JIT_VERSION} /usr/local/lib/Lua-Jit-${LUA_JIT_VERSION} && \
 	cd /usr/local/lib/Lua-Jit-${LUA_JIT_VERSION} && \
 	make && make install

# Install Nginx Devel Kit
RUN wget https://github.com/simplresty/ngx_devel_kit/archive/v${NGINX_DEVEL_KIT_VERSION}.tar.gz && \
	tar xvzf v${NGINX_DEVEL_KIT_VERSION}.tar.gz && \
	rm v${NGINX_DEVEL_KIT_VERSION}.tar.gz && \
	mv ngx_devel_kit-${NGINX_DEVEL_KIT_VERSION} /usr/local/lib/ngx_devel_kit-${NGINX_DEVEL_KIT_VERSION}

# Install Nginx Lua Module
RUN wget https://github.com/openresty/lua-nginx-module/archive/v${LUA_MODULE_VERSION}.tar.gz && \
	tar xvzf v${LUA_MODULE_VERSION}.tar.gz && \
	rm v${LUA_MODULE_VERSION}.tar.gz && \
	mv ./lua-nginx-module-${LUA_MODULE_VERSION} /usr/local/lib/lua-nginx-module-${LUA_MODULE_VERSION}

# Download Nginx
RUN wget https://nginx.org/download/nginx-${NGINX_VERSION}.tar.gz && \
	tar zxvf nginx-${NGINX_VERSION}.tar.gz && \
	rm nginx-${NGINX_VERSION}.tar.gz && \
	mv ./nginx-${NGINX_VERSION} /opt/nginx-${NGINX_VERSION}


#RUN git clone https://github.com/openresty/lua-resty-redis.git /usr/local/lib/lua-resty-redis && \
#	cd /usr/local/lib/lua-resty-redis && \
#	make install

ENV LUA_NGINX_MODULE_PATH /usr/local/lib/lua-nginx-module-${LUA_MODULE_VERSION}
ENV NGINX_DEVEL_KIT_PATH  /usr/local/lib/ngx_devel_kit-${NGINX_DEVEL_KIT_VERSION}

ENV LD_LIBRARY_PATH /usr/local/lib/:${LD_LIBRARY_PATH}

ENV LUAJIT_LIB /usr/local/bin/luajit
ENV LUAJIT_INC /usr/local/include/luajit-2.0

# Complie Nginx
RUN cd /opt/nginx-${NGINX_VERSION} && \
	./configure \
	--prefix=/etc/nginx \
	--sbin-path=/usr/sbin/nginx \
	--conf-path=/etc/nginx/nginx.conf \
	--error-log-path=/var/log/nginx/error.log \
	--http-log-path=/var/log/nginx/access.log \
	--pid-path=/var/run/nginx.pid \
	--lock-path=/var/run/nginx.lock \
	--http-client-body-temp-path=/var/cache/nginx/client_temp \
	--http-proxy-temp-path=/var/cache/nginx/proxy_temp \
	--http-fastcgi-temp-path=/var/cache/nginx/fastcgi_temp \
	--http-uwsgi-temp-path=/var/cache/nginx/uwsgi_temp \
	--http-scgi-temp-path=/var/cache/nginx/scgi_temp \
	--user=nginx \
	--group=nginx \
	--without-http_gzip_module \
	--with-ld-opt="-Wl,-rpath,/usr/local/lib" \
	--add-module=${LUA_NGINX_MODULE_PATH} \
	--add-module=${NGINX_DEVEL_KIT_PATH} && \
	make -j2 && \
	make install

# forward request and error logs to docker log collector
RUN ln -sf /dev/stdout /var/log/nginx/access.log \
	&& ln -sf /dev/stderr /var/log/nginx/error.log

RUN useradd --no-create-home nginx

COPY ./docker/local/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/local/nginx/vh.conf /etc/nginx/conf.d/nginx.conf

EXPOSE 80
EXPOSE 8001
EXPOSE 443

STOPSIGNAL SIGTERM

CMD ["nginx", "-g", "daemon off;"]
