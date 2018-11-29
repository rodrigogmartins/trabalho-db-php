CREATE DATABASE "tuitcher";

CREATE TABLE "usuario" (
    "id" SERIAL,
    "nome" VARCHAR(120) NOT NULL,
    "foto" VARCHAR(60),
    "senha" TEXT NOT NULL,
    "email" VARCHAR(254) NOT NULL,
    CONSTRAINT "usuarioPK" PRIMARY KEY ("id")
);

CREATE TABLE "post" (
    "id" SERIAL,
    "titulo" VARCHAR(60) NOT NULL,
    "descricao" TEXT NOT NULL,
    "foto" VARCHAR(60),
    "data" TIMESTAMP,
    "idusuario" INT,
    CONSTRAINT "postPK" PRIMARY KEY ("id"),
    CONSTRAINT "IdusuarioFK" FOREIGN KEY ("idusuario")
        REFERENCES "usuario"("id")
        ON DELETE CASCADE
        ON UPDATE NO ACTION
);

CREATE TABLE "comentario" (
    "id" SERIAL,
    "comentario" VARCHAR(250) NOT NULL,
    "data" TIMESTAMP NOT NULL,
    "idpost" INT,
    "idusuario" INT,
    CONSTRAINT "comentarioPK" PRIMARY KEY ("id"),
    CONSTRAINT "ComentarioPostFK" FOREIGN KEY ("idpost")
        REFERENCES "post"("id")
        ON DELETE CASCADE
        ON UPDATE NO ACTION,
    CONSTRAINT "ComentarioUsuarioFK" FOREIGN KEY ("idusuario")
        REFERENCES "usuario"("id")
        ON DELETE CASCADE
        ON UPDATE NO ACTION
);

CREATE TABLE "grupo" (
    "id" SERIAL,
    "nome" VARCHAR(30) NOT NULL,
    "foto" VARCHAR(30),
    CONSTRAINT "grupoPK" PRIMARY KEY ("id")
);

CREATE TABLE "usuariogrupo" (
    "id" SERIAL,
    "idusuario" INT,
    "idgrupo" INT,
    CONSTRAINT "usuariogrupoPK" PRIMARY KEY ("id"),
    CONSTRAINT "usuarioFK" FOREIGN KEY ("idusuario")
        REFERENCES "usuario"("id")
        ON DELETE CASCADE
        ON UPDATE NO ACTION,
    CONSTRAINT "grupoFK" FOREIGN KEY ("idgrupo")
        REFERENCES "grupo"("id")
        ON DELETE CASCADE
        ON UPDATE NO ACTION
);
