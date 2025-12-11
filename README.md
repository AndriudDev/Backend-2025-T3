# Backend-2025-T3
Backend 2025 T3. Sebastián Cabezas Ríos

## VcM

```sql
CREATE TABLE empresaTipo(
    id INT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    codigo VARCHAR(2) NOT NULL UNIQUE,
    icono_fa VARCHAR(50),
    color_tw VARCHAR(30),
    color_css VARCHAR(30),
    activo INT NOT NULL
);

INSERT INTO empresaTipo (id, nombre, codigo, icono_fa, color_tw, color_css, activo) VALUES (1, 'Reciclador de Base', 'R', 'fa fa-recycle', 'bg-green-100', 'rgb(220,252,231)', 1);

CREATE TABLE empresa(
    id INT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    empresaTipo_id INT NOT NULL,
    activo INT NOT NULL,
    FOREIGN KEY (empresaTipo_id) REFERENCES empresaTipo (id)
);

INSERT INTO empresa (id, nombre, empresaTipo_id, activo) VALUES (1, 'RECICLAJES SANTIAGO LTDA.', 1, 1);
```
